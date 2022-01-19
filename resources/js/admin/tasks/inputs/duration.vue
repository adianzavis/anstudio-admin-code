<template>
    <div class="form-control flex flex-row items-center mt-1">
        <img class="w-4 h-4 mr-2" src="/admin/images/clock.svg">
        <input :value='hours' @change="updateHours($event.target.value)" @keydown="checkCharacter" @focus="$event.target.select()" ref="hours" type="text" class="empty-input">:
        <input :value='minutes' @change="updateMinutes($event.target.value)" @keydown="checkCharacter" @focus="$event.target.select()" ref="minutes" type="text" class="empty-input">
    </div>
</template>

<script>
import moment from 'moment';

export default {
    computed: {
        hours() {
            return Math.floor(moment.duration(this.modelValue).asHours()).toString().padStart(2, '0');
        },
        minutes() {
            return Math.floor(moment.duration(this.modelValue).minutes()).toString().padStart(2, '0');
        }
    },
    methods: {
        updateHours(hours) {
            this.$emit("update:modelValue", moment.duration({
                hours: this.parse(hours),
                minutes: this.minutes,
            }).toISOString());
        },
        updateMinutes(minutes) {
            this.$emit("update:modelValue", moment.duration({
                hours: this.hours,
                minutes: this.parse(minutes),
            }).toISOString());
        },
        parse(time) {
            return parseInt(time) || 0;
        },
        checkCharacter(event) {
            const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Shift', 'Control', 'Tab'];

            if (!event.key.match('[0-9]') && !allowedKeys.includes(event.key)) {
                event.preventDefault();
            }
        },
    },
    props: {
        modelValue: String,
    }
}
</script>

<style scoped>
.empty-input {
    all: unset;
    height: 100%;
    width: 100%;
    text-align: center;
}
</style>
