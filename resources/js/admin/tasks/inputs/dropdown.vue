<template>
    <select :value='modelValue' @input='$emit("update:modelValue", $event.target.value)' ref="dropdown" class="validate-input rounded-md w-full mt-1" :data-placeholder="placeholder">
        <option v-for="option in options" :value="option.id">{{ option.name }}</option>
    </select>
</template>

<script>
import tail from "tail.select";

export default {
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

        tail(this.$refs.dropdown, options);
    },
    props: {
        options : Object,
        modelValue: String,
        placeholder: [String, null],
    }
}
</script>
