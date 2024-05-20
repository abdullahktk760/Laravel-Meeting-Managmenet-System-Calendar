
$(function () {
    'use strict';

    var bootstrapForm = $('.needs-validation'),
        jqForm = $('#addMeetingForm');

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
                },
                'description': {
                    required: true,
                },
                'organizer_email': {
                    required: true,
                },
                'attendee_1': {
                    required: true,
                },
                'attendee_2': {
                    required: true,
                },
                'start_date_end_date': {
                    required:true,
                }
            },
        });
    }
});
