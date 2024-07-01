document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    const dateFrom = document.getElementById('request_leave_date_from');
    const dateTo = document.getElementById('request_leave_date_to');

    dateFrom.setAttribute('min', today);
    dateTo.setAttribute('min', today);

    dateFrom.addEventListener('change', function () {
        dateTo.setAttribute('min', this.value);
    });

    $('#leaveRequestForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to submit this leave request?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/leave_requests', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.message) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $('#leaveRequestForm')[0].reset();
                                $('#leaveRequestModal').modal('hide');
                                // Optionally reload the table to show the new leave request
                                location.reload();
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
