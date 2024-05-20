$(document).ready(function () {
    permissions();
});
function permissions() {
    var dataSet = [];
    $.ajax({
        url: "permissions/create",
        type: "get",
        dataType: "json",
        success: function (data) {
            dataSet = data.roles;
            $("#myTable").DataTable().destroy();
            $("#myTable").DataTable({
                data: dataSet,
                columns: [
                    {   title: "Roles",
                        data: data,

                    },
                    {
                        // Actions
                        targets: -1,
                        title: "Actions",
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return (
                                '<button class="btn btn-sm btn-icon assign-permission" data-bs-toggle="modal" data-role=' +
                                full +
                                ' data-bs-target="#editPermissionModal">' +
                                feather.icons["edit"].toSvg({
                                    class: "font-medium-2 text-body",
                                }) +
                                "</i></button>" +
                                '<button class="btn btn-sm btn-icon delete-record delete-permission" data-role='+full+'>' +
                                feather.icons["trash"].toSvg({
                                    class: "font-medium-2 text-body",
                                }) +
                                "</button>"
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




// Getting data from model data from db by roleName with url
var role = "";
var token = "";
$("#myTable").on("click", ".assign-permission", function () {
    token = $("#cs").attr("content");
    role = $(this).data("role");

    $.ajax({
        type: "get",
        headers: {
            "X-CSRF-TOKEN": token,
        },
        dataType: "json",
        url: "/get-permi/" + role,
        success: function (response) {
            var permissionsContainer = $("#permission");
            permissionsContainer.empty();

            permissionsContainer.append(`
                    <tr>
                        <td class="text-nowrap fw-bolder">
                            Administrator Access
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                <i data-feather="info"></i>
                            </span>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                <label class="form-check-label" for="selectAll"> Select All </label>
                            </div>
                        </td>
                    </tr>
                `);
            // Add module and permissions rows
            $.each(
                response.permission,
                function (moduleName, modulePermissions) {
                    permissionsContainer.append(`
                            <tr>
                                <td class="text-nowrap fw-bolder" id="module">${moduleName}</td>
                                <td>
                                    ${Object.entries(modulePermissions)
                                        .map(
                                            ([
                                                permissionName,
                                                hasPermission,
                                            ]) => `
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="checkbox_${permissionName}" name="${permissionName}" ${
                                                hasPermission ? "checked" : ""
                                            } />
                                                <label class="form-check-label" for="checkbox_${permissionName}">
                                                    ${permissionName}
                                                </label>
                                            </div>
                                        </div>
                                    `
                                        )
                                        .join("")}
                                </td>
                            </tr>
                        `);
                }
            );
        },
        error: function (error) {
            console.error(error);
            // Handle errors here
        },
    });
});


var checkedNames = [];

$(document).on("change", '[type="checkbox"]', function () {
   var checkedCheckboxes = $('[type="checkbox"]:checked');
    checkedNames = checkedCheckboxes
        .map(function () {
            return $(this).attr("name");
        })
        .get();
});

$("#submit").click(function (e) {
    console.log(checkedNames);
    e.preventDefault();
    $.ajax({
        type: "post",
        headers: {
            "X-CSRF-TOKEN": token,
        },
        data: { role: role, name: checkedNames },
        url: "/permissionUpdate",
        success: function (response) {
            console.log(response);
        },
    });
});

$("#myTable").on("click", ".delete-permission", function () {
    var token = $("#cs").attr('content');

    var roleName = $(this).data("role");
console.log(roleName);
    $.ajax({
        type: "delete",
        headers: {
            "X-CSRF-TOKEN": token
        },
        url: "permissions/"+roleName,
        data: { role: roleName},
        success: function (response) {

            permissions();
        }
    });
});