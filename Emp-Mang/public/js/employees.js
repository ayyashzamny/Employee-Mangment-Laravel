document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTable
    $('#employeeTable').DataTable();

    // Auto-populate full name based on first and last name inputs
    $('#first_name, #last_name').on('input', function () {
        const firstName = $('#first_name').val();
        const lastName = $('#last_name').val();
        $('#full_name').val(`${firstName} ${lastName}`);
    });

    // Handle form submission for adding a new employee
    $('#addEmployeeForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to add this employee?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Add',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/employees/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $('#addEmployeeModal').modal('hide');
                                $('#employeeTable').DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    });

    // Function to fetch departments and designations
    function fetchDepartmentsAndDesignations() {
        fetch('/departments/list')
            .then(response => response.json())
            .then(data => {
                $('#department_id').empty().append('<option value="">Select Department</option>');
                data.forEach(dept => {
                    $('#department_id').append(`<option value="${dept.id}">${dept.Description}</option>`);
                });
            });

        fetch('/designations/list')
            .then(response => response.json())
            .then(data => {
                $('#designation_id').empty().append('<option value="">Select Designation</option>');
                data.forEach(desig => {
                    $('#designation_id').append(`<option value="${desig.id}">${desig.Description}</option>`);
                });
            });
    }

    // Initial fetch for departments and designations
    fetchDepartmentsAndDesignations();

    // Handle form submission for adding a new department
    $('#addDepartmentForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to add this department?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Add',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/departments/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $('#addDepartmentModal').modal('hide');
                                fetchDepartmentsAndDesignations();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    });

    // Handle form submission for adding a new designation
    $('#addDesignationForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to add this designation?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Add',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/designations/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $('#addDesignationModal').modal('hide');
                                fetchDepartmentsAndDesignations();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    });
});
