
$(function () {
    'use strict';

    var bootstrapForm = $('.needs-validation'),
        jqForm = $('#addRoleForm');

    // Bootstrap Validation
    // --------------------------------------------------------------------
    if (bootstrapForm.length) {
        Array.prototype.filter.call(bootstrapForm, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    form.classList.add('invalid');
                }
                form.classList.add('was-validated');
                event.preventDefault();
            });
        });
    }

    // jQuery Validation
    // --------------------------------------------------------------------
    if (jqForm.length) {
        jqForm.validate({
            rules: {
                'title': {
                    required: true,
                    maxlength: 30
                },
                'description': {
                    required: true,
                },
                'status': {
                    required: true,
                },

            },
            messages: {
                'title':{
                    required:'Task title is required.',
                    maxlength:'Task title should not exceed 30 characters.',
                },
                'description':{
                    required:'Task description is required.',
                }

            },
        });
    }
});
