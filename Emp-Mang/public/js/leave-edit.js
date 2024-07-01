document.addEventListener('DOMContentLoaded', function () {
    // Get the edit form element
    const editLeaveForm = document.getElementById('editLeaveForm');
    
    // Get references to the modal and its components
    const editLeaveModal = new bootstrap.Modal(document.getElementById('editLeaveRequestModal'));
    
    // Add submit event listener to the edit form
    editLeaveForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Get values from form inputs
        const leaveId = document.getElementById('editLeaveId').value;
        const confirmedStatus = document.getElementById('editConfirmedStatus').value;
        const confirmedLeaveDateFrom = document.getElementById('editLeaveDateFrom').value;
        const confirmedLeaveDateTo = document.getElementById('editLeaveDateTo').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show confirmation dialog using Swal (SweetAlert)
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to update this leave request?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the update request
                fetch(`/admin-leaves/${leaveId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        confirmed_status: confirmedStatus,
                        confirmed_leave_date_from: confirmedLeaveDateFrom,
                        confirmed_leave_date_to: confirmedLeaveDateTo
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // If update is successful, show success message
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            editLeaveModal.hide(); // Close the modal
                            window.location.reload(); // Reload page after success
                        });
                    } else {
                        // If update fails, show error message
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    // Catch any network or server errors
                    console.error('Error:', error);
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

    // Add click event listeners to all elements with class '.edit-button'
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default button behavior

            // Get data attributes from clicked edit button
            const leaveId = this.getAttribute('data-id');
            const confirmedStatus = this.getAttribute('data-status');
            const confirmedLeaveDateFrom = this.getAttribute('data-date-from');
            const confirmedLeaveDateTo = this.getAttribute('data-date-to');

            // Set values in edit form fields
            document.getElementById('editLeaveId').value = leaveId;
            document.getElementById('editConfirmedStatus').value = confirmedStatus;
            document.getElementById('editLeaveDateFrom').value = confirmedLeaveDateFrom;
            document.getElementById('editLeaveDateTo').value = confirmedLeaveDateTo;

            // Show the modal
            editLeaveModal.show();
        });
    });

    // Close the modal when the close button is clicked
    document.querySelectorAll('.btn-close').forEach(button => {
        button.addEventListener('click', function () {
            editLeaveModal.hide();
        });
    });
});
