window.onload = function() {

    document.querySelectorAll('[data-step-to]').forEach(e => e.addEventListener('click', function (e) {
        const oldStep = e.target.closest('.form-step');
        const newStep = document.querySelector('[data-step="' + e.target.dataset.stepTo + '"]');
        const oldIndicator = document.querySelector('[data-step-indicator="' + oldStep.dataset.step + '"]');
        const newIndicator = document.querySelector('[data-step-indicator="' + e.target.dataset.stepTo + '"]');

        oldStep.classList.add('disappear');
        oldIndicator.classList.remove('active');
        setTimeout(() => {
            newStep.classList.remove('hidden');
            oldStep.classList.add('hidden');
            newIndicator.classList.add('active');
            setTimeout(() => newStep.classList.remove('disappear'), 10);
        }, 202);
    }));

    document.querySelectorAll('.photo-select').forEach(e => e.addEventListener('change', function(e) {
        const imageBox = e.target.closest('.photo-select-template-wrapper').querySelector('.photo-select-template');
        imageBox.src = window.URL.createObjectURL(e.target.files[0]);
    }))

    document.querySelectorAll('.photo-select-template').forEach(e => e.addEventListener('click', function(e) {
        const imageInput = e.target.closest('.photo-select-template-wrapper').querySelector('.photo-select');
        imageInput.value = null;
        if (e.target.parentElement.querySelector('.photo-select-original'))
            e.target.src = e.target.parentElement.querySelector('.photo-select-original').src;
        else
            e.target.src = '/admin/images/profile-17.jpg';
    }))

    if (document.querySelector('[name="per_page"]')) {
        document.querySelector('[name="per_page"]').addEventListener('change', e => {
            e.target.form.submit();
        });
    }

    document.querySelectorAll('.image-option').forEach(e => e.addEventListener('click', function(event) {
        const parent = document.querySelector(this.closest('.dropdown-menu').getAttribute('data-target'));

        parent.querySelector('.selected-image').src = this.querySelector('.image-dropdown-image').src;
        parent.querySelector('.selected-label').innerHTML = this.querySelector('.image-dropdown-name').innerHTML;
        parent.querySelector('.selected-value').value = this.getAttribute('data-id');

        cash(parent).dropdown('hide');
    }))

    document.querySelectorAll('[data-toggle="click"]').forEach(e => {
        e.addEventListener('click', () => {
            document.querySelector(e.getAttribute('data-target')).click()
        });
    });
}
