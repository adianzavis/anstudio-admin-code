<template>
    <transition name="fade" mode="in-out">
        <div v-if="errors" id="notification-message">
            <div class="alert alert-danger show flex items-center justify-between mb-1 p-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle block mx-auto block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span class="pl-1 pr-10 text-white flex flex-cols w-full ml-5">Something went wrong. Try it please later.</span>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: [ 'errors' ],
}
</script>

<style scoped>
#notification-message {
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
