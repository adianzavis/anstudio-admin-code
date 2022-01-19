<template>
    <div id="create-new-popup" class="fixed w-screen h-screen left-0">
        <div class="relative w-full h-full z-50">
            <div id="create-background" @click="$emit('close')" class="absolute w-full h-full bg-black bg-opacity-50 z-50 left-0 top-0"></div>
            <div id="create-container" class="absolute right-0 top-0 h-full bg-dark-1 p-5 z-50 overflow-y-scroll">
                <h3 class="text-lg font-medium mb-5">Task detail</h3>
                <div id="form">
                    <div class="mt-3 grid grid-cols-2 gap-4">
                        <div class="col-span-2 grid grid-cols-2 gap-4">
                            <div class="col-span-2" :class="{'has-error': formErrors.name ?? false}">
                                <label>Name *</label>
                                <input v-model="formData.name" ref="name" type="text" class="form-control mt-1">
                                <small class="text-red-300">{{ formErrors.name ? formErrors.name[0] : '' }}</small>
                            </div>
                            <div class="flex flex-col space-y-4">
                                <div class="col-span-2" :class="{'has-error': formErrors.assignees ?? false }">
                                    <label>Assignees</label>

                                    <small class="text-red-300">{{ formErrors.assignees ? formErrors.assignees[0] : '' }}</small>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-1" :class="{'has-error': formErrors.duration ?? false}">
                                        <label>Duration</label>
                                        <duration v-model="formData.duration" ref="duration"/>
                                        <small class="text-red-300">{{ formErrors.duration ? formErrors.duration[0] : '' }}</small>
                                    </div>
                                    <div class="col-span-1" :class="{'has-error': formErrors.duration_budget ?? false}">
                                        <label>Duration budget</label>
                                        <duration v-model="formData.duration_budget" ref="duration_budget"/>
                                        <small class="text-red-300">{{ formErrors.duration_budget ? formErrors.duration_budget[0] : '' }}</small>
                                    </div>
                                </div>
                                <div class="col-span-2" :class="{'has-error': formErrors.money_budget ?? false}">
                                    <label>Money budget</label>
                                    <money v-model="formData.money_budget" ref="money_budget"/>
                                    <small class="text-red-300">{{ formErrors.money_budget ? formErrors.money_budget[0] : '' }}</small>
                                </div>
                                <div class="col-span-2" :class="{'has-error': formErrors.money_budget ?? false}">
                                    <multiselect v-model="formData.assignees" :options="assignees" :multiple="true" track-by="id" label="name" :close-on-select="false" placeholder="Select assignees"></multiselect>
                                </div>
                            </div>
                            <div class="block flex flex-col" :class="{'has-error': formErrors.dates ?? false}">
                                <label class="pb-1">Dates *</label>
                                <date-picker ref="dates" v-model="formData.dates" color="indigo" is-dark is-range is-expanded/>
                                <small class="text-red-300">{{ formErrors.dates ? formErrors.dates[0] : '' }}</small>
                            </div>
                        </div>
                        <div class="col-span-2" :class="{'has-error': formErrors.description ?? false}">
                            <label class="form-label">Description</label>
                            <ckeditor v-model="formData.description"/>
                            <small class="text-red-300">{{ formErrors.description ? formErrors.description[0] : '' }}</small>
                        </div>
                        <div class="col-span-2">
                            <error-message :errors="formErrors.project ?? false"/>
                        </div>
                        <button @click="saveTask" @blur="resetErrors" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CKEditor from '../inputs/ckeditor-lite';
import Multiselect from 'vue-multiselect'
import DurationInput from '../inputs/duration';
import MoneyInput from '../inputs/money';
import ErrorMessage from '../inputs/error-message';
import { DatePicker } from 'v-calendar';
import moment from 'moment';
import axios from 'axios';

export default {
    mounted() {
        if(this.taskId) {
            axios.get(`/admin/task/${this.taskId}`).then(response => {
                if(response.status === 200) {
                    this.formData = {
                        id : response.data.id,
                        project : window.projectId,
                        name : response.data.name,
                        assignees: response.data.assignees,
                        duration : response.data.formatted_duration,
                        duration_budget : response.data.formatted_duration_budget,
                        description : response.data.description,
                        money_budget : {
                            amount: response.data.money_budget,
                            currency: response.data.currency_iso,
                        },
                        dates : {
                            start: moment(response.data.start).format(),
                            end: moment(response.data.deadline).format(),
                        },
                    };
                    setTimeout(this.$refs.dates.move(moment(response.data.start).format()), 300);
                }
            }).catch(error => {
                return false;
            });
        }
    },
    data() {
        return {
            formData : {
                project : window.projectId,
                name : null,
                assignees: [],
                duration : null,
                description : null,
                duration_budget : null,
                money_budget : {},
                dates : null,
            },
            formErrors: { },
        };
    },
    methods: {
        saveTask() {
            const data = {
                _token : window.token,
                status_id : this.statusId,
                ...this.formData,
            };
            axios.post(`/admin/task/${this.formData.id}/update`, data).then(response => {
                if(response.status === 200) {
                    this.$emit('update', response.data);
                    this.$emit('close');
                    this.clearForm();
                }
            }).catch(error => {
                this.formErrors = error.response.data.errors;
            });
        },
        clearForm() {
            this.formData = {
                project : window.projectId,
                name : null,
                assignees: null,
                duration : null,
                description : null,
                duration_budget : null,
                money_budget : {},
                dates : null,
            }
        },
        resetErrors() {
            this.formErrors = {};
        }
    },
    props: {
        display: Boolean,
        taskId: Number,
        statusId: Number,
        assignees: [Object, null],
    },
    components: {
        multiselect: Multiselect,
        duration: DurationInput,
        money: MoneyInput,
        errorMessage: ErrorMessage,
        datePicker: DatePicker,
        ckeditor: CKEditor,
    },
    emits: ['close', 'add', 'update'],
}
</script>

<style scoped>
#create-new-popup {
    z-index: 100;
    top: 0;
    left: 0;
    transition: all 0.33s ease;
}

#create-container {
    width: 50vw;
    max-width: 650px;
}

#create-background, #create-container {
    transition: all 0.33s ease;
}
.fade-enter-from #create-background, .fade-leave-to #create-background {
    opacity: 0;
}
.fade-enter-to #create-background, .fade-leave-from #create-background {
    opacity: 1;
}

.fade-enter-from #create-container, .fade-leave-to #create-container {
    transform: translateX(100%);
}
.fade-enter-to #create-container, .fade-leave-from #create-container {
    transform: translateX(0%);
}
</style>
