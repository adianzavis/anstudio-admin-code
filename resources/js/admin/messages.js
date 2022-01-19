import Toastify from 'toastify-js';

const showNotificationMessage = () => {
    Toastify({
        node: cash("#notification-message")
            .clone()
            .removeClass("hidden")[0],
        duration: 4000,
        newWindow: true,
        close: true,
        gravity: "bottom",
        position: "right",
        stopOnFocus: true
    }).showToast();
}

if (document.querySelector('#notification-message.message'))
    setTimeout(showNotificationMessage, 500);
