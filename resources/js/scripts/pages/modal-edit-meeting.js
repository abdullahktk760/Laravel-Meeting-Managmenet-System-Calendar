$(document).ready(function () {
    // Hide the error message after 3 seconds
    setTimeout(function () {
        var errorMessage = document.getElementById('flash-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 4000);

    // Initialize the datatable
    $('#myTable').DataTable();


    // Get data for edit modal
    $('.get_data_for_edit_modal').on('click', function () {
        var id = $(this).data('meeting-id');

        $.ajax({
            type: "get",
            url: "/meeting/" + id + "/edit",
            dataType: "json",
            success: function (response) {

                $('#editMeetingModal').find('.modal-body #title').val(response.subject);
                $('#editMeetingModal').find('.modal-body #attendee_1').val(response.attendee1_email);
                $('#editMeetingModal').find('.modal-body #attendee_2').val(response.attendee2_email);
                $('#editMeetingModal').find('.modal-body #meeting_time').val(response.meeting_time);
                $('#editMeetingModal').find('.modal-body #organizer_email').val(response.organizer_email);
                $('#editMeetingModal').find('.modal-body #fp-range').val(response.start_date_time);
                $('.edit_meeting_form').attr('action', "/meeting/" + response.id);
            }
        });
    });
});
