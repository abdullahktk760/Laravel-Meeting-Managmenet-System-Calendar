$(document).ready(function () {
    applyFilter();
});
function applyFilter() {
    var dataSet = [];
    var roles = {};
    $.ajax({
        url: "ajax-data",
        type: "get",
        dataType: "json",
        success: function (data) {
            $.each(data.user, function (index, userData) {
                dataSet[index] = [
                    userData.id,
                    userData.name,
                    userData.email,
                    userData.userRoles,
                ];

                roles = data.role;
            });

            $("#myTable").DataTable().destroy();
             $("#myTable").DataTable({
                data: dataSet,
                columns: [
                    { data: 0 },
                    { data: 1 },
                    { data: 2 },
                    { data: 3 },
                    {
                        data: null,
                        title: "Action",
                        render: function (data) {
                            var userId = data[0];

                            var roleMenu = '<div class="dropdown-menu dropdown-menu-end">';
                            $.each(roles, function (index, roleName) {
                                roleMenu += '<a href="javascript:;" class="dropdown-item assign-role" data-user-id="' + userId + '" data-role="' + roleName + '">' + roleName + '</a>';
                            });
                            roleMenu += '</div>';
                            return (
                                '<div class="d-inline-flex">' +
                                '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                                feather.icons["more-vertical"].toSvg({
                                    class: "font-small-4",
                                }) +
                                roleMenu +
                                "</a>" +
                                "</div>"
                            );
                        },
                    },
                ],
            });
        },
        error: function (error) {
            console.log(error);
        },
    });

}

$("#myTable").on("click", ".assign-role", function () {
    var token = $("#cs").attr('content');
    var userId = $(this).data("user-id");
    var roleName = $(this).data("role");

    $.ajax({
        type: "post",
        headers: {
            "X-CSRF-TOKEN": token
        },
        url: "assign-role",
        data: { role: roleName, id: userId },
        success: function (response) {
            console.log(response);
            applyFilter()
        }
    });
});
