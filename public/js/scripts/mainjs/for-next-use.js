$(document).ready(function () {
    applyFilter();
});

$('#employees-table').DataTable({
    "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, 'All']
    ],
    "order": [],
    "drawCallback": function (settings) {
        feather.replace();
        $('[data-toggle="tooltip"]').tooltip();
    }
});

feather.replace();
$('[data-toggle="tooltip"]').tooltip();

$("#save_btn").on('click', function () {
    $("#csv").val('0')
    $("#save-form").submit();
});

function applyFilter() {
    var departments = $("#departments").val();
    var locations = $("#locations").val();
    var divisions = $("#divisions").val();
    var employment_status = $("#employment_status").val();
    var designations = $("#designations").val();
    var status = $("#status").val();

    var url = '/en/employees/filter/by/ajax';

    $(document).ready(function () {
        dataSet = [];

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: { departments: departments, locations: locations, divisions: divisions, employment_status: employment_status, designations: designations, status: status },
            success: function (data) {
                $.each(data, function (index, val) {
                    let baseUrl = window.location.protocol + "//" + window.location.host + "/";
                    let avatarHtml = '';

                    if (val.employee.picture) {
                        avatarHtml = '<img class="round" src="' + baseUrl + val.employee.picture + '" onerror="this.src =\'' + baseUrl + 'default_user_image.png\';" alt="avatar" height="40px" width="40px">';
                    } else {
                        avatarHtml = '<div class="border-secondary rounded-circle" style="background-color: #008dc7; display: flex; align-items: center; justify-content: center; min-height: 40px; min-width: 40px; max-height: 40px; max-width: 40px;">' + val.employee.acronym + '</div>';
                    }

                    let fullNameHtml = '<div class="d-flex justify-content-left align-items-center">' +
                        '<div class="avatar-wrapper">' +
                        '<div class="avatar mr-1">' + avatarHtml + '</div>' +
                        '</div>' +
                        '<div class="d-flex flex-column">' +
                        '<span class="font-weight-bold" id="name">' + val.employee.full_name + '</span>' +
                        '</div>' +
                        '</div>';

                    let statusBadgeHtml = '';

                    if (val.employee.status == 1) {
                        statusBadgeHtml = '<span class="badge badge-light-success">Active</span>';
                    } else {
                        statusBadgeHtml = '<span class="badge badge-light-danger">Inactive</span>';
                    }


                    let actionHtml = '';

                    if (val.hasPermission) {
                        actionHtml += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="' + baseUrl + (val.locale ? val.locale : 'en') + '/employee/edit/' + val.employee.id + '" data-toggle="tooltip" data-original-title="Edit Employee"><i data-feather="edit-2" class="mr-40"></i></a>';
                    }

                    if (val.isAdmin || (val.permissions.approvals.all && val.permissions.approvals.all.includes('manage setting approval')) || (val.permissions.approvals[val.employee.id] && val.permissions.approvals[val.employee.id]['employee approval_history'] == 'view')) {
                        actionHtml += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="' + baseUrl + (val.locale ? val.locale : 'en') + '/employees/' + val.employee.id + '/approval-history" data-toggle="tooltip" data-original-title="Employee Approvals"><i data-feather="user-check" class="mr-40"></i></a>';
                    }

                    if (val.aiRetentionPermission) {
                        if (authUser.id !== val.employee.id && val.isAdmin || (val.permissions.aiRetention.all && val.permissions.aiRetention.all.includes('manage employee flight_risk_score')) || val.permissions.aiRetention[val.employee.id]) {
                            actionHtml += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="' + baseUrl + (val.locale ? val.locale : 'en') + '/employees/' + val.employee.id + '/flight-risk-score/" data-toggle="tooltip" data-original-title="Flight Risk Score"><i class="fas fa-plane-departure"></i></a>';
                        }
                    }

                    if (val.timeTrackingPermission) {
                        if (val.userId == val.employee.id) {
                            if (val.employee.can_mark_attendance == 1 && val.permissions && val.permissions.attendance) {
                                actionHtml += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="tooltip" data-placement="top" title="View Employee Attendance" href="' + baseUrl + (val.locale ? val.locale : 'en') + '/employees/' + val.employee.id + '/employee-attendance"><i data-feather=\'file-minus\'></i></a>';
                            }
                        } else {
                            actionHtml += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="tooltip" data-placement="top" title="View Employee Attendance" href="' + baseUrl + (val.locale ? val.locale : 'en') + '/employees/' + val.employee.id + '/employee-attendance"><i data-feather=\'file-minus\'></i></a>';
                        }
                    }

                    let designationName = '';

                    if (val.employee.jobs && val.employee.jobs[0]) {
                        designationName = val.employee.jobs[0].designation ? val.employee.jobs[0].designation.designation_name : '';
                    }

                    dataSet[index] = [fullNameHtml, val.employee.father_name, val.employee.official_email, designationName,
                        val.employee.employment_status ? val.employee.employment_status.employment_status : '', statusBadgeHtml, actionHtml
                    ];

                });


                $('#work-from-home-table').DataTable().destroy();
                $('#work-from-home-table').DataTable({
                    "createdRow": function (row, data, dataIndex) {
                        $(row).find('td:eq(0)').html(data[0]);
                        $(row).find('td:eq(6)').html(data[6]);
                    },
                    "aaSorting": [],
                    data: dataSet,
                    "columnDefs": [
                        { className: "text-nowrap text-center", "targets": [0] },
                        { className: "text-nowrap text-center", "targets": [1] },
                        { className: "text-nowrap text-center", "targets": [2] },
                        { className: "text-nowrap text-center", "targets": [3] },
                        { className: "text-nowrap text-center", "targets": [4] },
                        { className: "text-nowrap text-center", "targets": [5] },
                        { className: "text-nowrap text-center", "targets": [6] },
                    ],
                    "drawCallback": function (settings) {
                        feather.replace();
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                });

                feather.replace();
                $('[data-toggle="tooltip"]').tooltip();
            }, error: function (error) {
                console.log(error);
            }
        });
    });


}

$(document).ready(function () {

    if (addEmployees == 0) {
        $('.addEmployee').addClass('disabled');
    }
    else {
        $('.addEmployee').removeClass('disabled');
        $('#addEmployeeTooltip').tooltip("disable");
    }
});