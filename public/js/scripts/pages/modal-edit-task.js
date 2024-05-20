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
        var id = $(this).data('task-id');

        $.ajax({
            type: "get",
            url: "/tasks/" + id + "/edit",
            dataType: "json",
            success: function (response) {

                $('#editTaskModal').find('.modal-body #title').val(response.title);
                $('#editTaskModal').find('.modal-body #description').val(response.description);
                $('#editTaskModal').find('.modal-body #status option[value="' + response.status + '"]').prop('selected', true);
                if (response.user) {
                    var userName = response.user.name;
                    $('#editTaskModal').find('.modal-body #user_id option').each(function () {
                        if ($(this).text() === userName) {
                            $(this).prop('selected', true);
                            return false; // Exit the loop once the option is selected
                        }
                    });
                }
                $('.edit_form').attr('action', "/tasks/" + response.id);
            }
        });
    });
});
