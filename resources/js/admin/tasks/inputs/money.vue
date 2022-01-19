<template>
    <div class="form-control relative flex flex-row items-center justify-between mt-1 overflow-hidden">
        <img class="w-4 h-4 mr-2" src="/admin/images/icon-eur.png">
        <input :value='amount' @change="updateAmount($event.target.value)" @keydown="checkCharacter" @focus="$event.target.select()" type="text" class="empty-input">
        <div @click="dropdownVisible = !dropdownVisible" class="absolute right-0 top-0 w-16 h-full bg-dark-4 px-2 flex rounded-r-md items-center justify-center cursor-pointer">
            {{ currency }}
        </div>
        <transition name="fade" mode="in-out">
            <div v-if="dropdownVisible" class="dropdown-area absolute left-0 top-0 w-full h-full bg-dark-4 px-2 rounded-md flex flex-row justify-center cursor-pointer">
                <span v-for="item in availableCurrencies" @click="updateCurrency(item.iso)" class="py-1 w-full flex justify-center items-center">{{ item.iso }}</span>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            /*amount: this.modelValue.amount ?? '0.00',
            currency: this.modelValue.currency ?? window.availableCurrencies[0].iso,*/
            availableCurrencies: window.availableCurrencies,
            dropdownVisible: false,
        }
    },
    computed: {
        amount() {
            return this.formatAmount(this.parseAmount(this.modelValue.amount));
        },
        currency() {
            return this.modelValue.currency ?? window.availableCurrencies[0].iso;
        }
    },
    methods: {
        updateAmount(amount) {
            this.$emit("update:modelValue", {
                amount: this.formatAmount(this.parseAmount(amount)),
                currency: this.currency,
            });
        },
        updateCurrency(currency) {
            this.$emit("update:modelValue", {
                amount: this.amount,
                currency: currency,
            });

            this.dropdownVisible = false;
        },
        formatAmount(amount) {
            return amount.toFixed(2);
        },
        parseAmount(amount) {
            return parseFloat(amount) || 0;
        },
        checkCharacter(event) {
            const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Shift', 'Control', 'Tab'];

            if (!event.key.match('[0-9.]') && !allowedKeys.includes(event.key)) {
                event.preventDefault();
            }
        },
    },
    props: {
        modelValue: Object,
    }
}
</script>

<style scoped>
.empty-input {
    all: unset;
    height: 100%;
    width: 100%;
}
.dropdown-area {
    transition: all 0.25s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
    transform: translateX(20px);
}
.fade-enter-to, .fade-leave-from {
    opacity: 1;
    transform: translateX(0);
}
</style>
