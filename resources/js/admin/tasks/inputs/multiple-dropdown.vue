<template>
    <div>
        <select v-model="modelValue" @change="$emit('update:modelValue', this.modelValue);" name="dropdown[]" ref="dropdown" class="validate-input rounded-md w-full mt-1" :data-placeholder="placeholder" multiple>
            <option v-for="option in options" :value="option.id">{{ option.name }}</option>
        </select>
        <button @click="setSelected" class="btn btn-primary" type="button">Set values</button>
        <button @click="printValues" class="btn btn-primary" type="button">Print values</button>
    </div>
</template>

<script>
import tail from "tail.select";

export default {
    data() {
        return {
            select: null,
        }
    },
    methods: {
        setSelected() {
            tail(this.$refs.dropdown).reload();
        },
    },
    mounted() {
        let options = {};

        if (this.$refs.dropdown.getAttribute("placeholder")) {
            options.placeholder = this.$refs.dropdown.getAttribute("placeholder");
        }

        if (cash(this.$refs.dropdown).attr("class") !== undefined) {
            options.classNames = cash(this.$refs.dropdown).attr("class");
        }

        if (cash(this.$refs.dropdown).data("search")) {
            options.search = true;
        }

        if (cash(this.$refs.dropdown).attr("multiple") !== undefined) {
            options.descriptions = true;
            options.hideSelected = true;
            options.hideDisabled = true;
            options.multiLimit = 10;
            options.multiShowCount = false;
            options.multiContainer = true;
        }

        this.select = tail(this.$refs.dropdown, options);
    },
    props: {
        options : Object,
        modelValue: Array,
        placeholder: [String, null],
    }
}
</script>
