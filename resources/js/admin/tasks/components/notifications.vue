<template>
</template>

<script>
import Toastify from 'toastify-js';

export default {
    notify(message, type = "success") {

        var node = document.querySelector('#notification-message').cloneNode();
        node.classList.remove('hidden');
        node.children[0].classList.add(`alert-${type}`);
        //node.querySelector('#text').innerHTML = message;

        Toastify({
            node: node,
            duration: 4000,
            newWindow: true,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true
        }).showToast();
    }
}
</script>

<style scoped>

</style>
