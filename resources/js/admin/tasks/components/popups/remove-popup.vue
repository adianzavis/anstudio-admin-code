<template>
    <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <svg class="w-16 h-16 text-theme-6 mx-auto mt-3">
                            <use xlink:href="admin/images/reject-icon.svg#id"></use>
                        </svg>
                        <div class="text-3xl mt-5"><slot name="question"></slot></div>
                        <div class="text-gray-600 mt-2">
                            <slot name="text"></slot>
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button @click="cancel" type="button" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">
                            Cancel
                        </button>
                        <button @click="closure" type="submit" class="btn btn-danger w-24">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        image: 'String',
        closure: 'Function',
        cancel: 'Function',
    }
}
</script>

<style scoped>

</style>
