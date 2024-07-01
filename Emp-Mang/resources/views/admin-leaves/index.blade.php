<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Leave Requests</title>
</head>

<body>
    @include('layouts.header')

    <div class="container">
        <h2 class="text-center mb-4">Leave Requests</h2>
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <div class="row">
            @foreach($leaveRequests as $leaveRequest)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title">Leave Request</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>Employee ID:</strong> {{ $leaveRequest->employee->id }}</p>
                                    <p class="card-text"><strong>Date:</strong> {{ $leaveRequest->date }}</p>
                                    <p class="card-text"><strong>Leave Type:</strong>
                                        @php
                                            switch ($leaveRequest->leave_type_id) {
                                                case 1:
                                                    echo 'Medical';
                                                    break;
                                                case 2:
                                                    echo 'Casual';
                                                    break;
                                                default:
                                                    echo 'Unknown';
                                            }
                                        @endphp
                                    </p>
                                    <p class="card-text"><strong>Request Leave Date From:</strong>
                                        {{ $leaveRequest->request_leave_date_from }}</p>
                                    <p class="card-text"><strong>Request Leave Date To:</strong>
                                        {{ $leaveRequest->request_leave_date_to }}</p>
                                    <p class="card-text"><strong>Description:</strong> {{ $leaveRequest->description }}</p>
                                    <p class="card-text"><strong>Confirmed Status:</strong> {{ $leaveRequest->confirmed_status }}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('admin-leaves.show', $leaveRequest->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <button class="btn btn-primary btn-sm edit-button" data-id="{{ $leaveRequest->id }}"
                                        data-status="{{ $leaveRequest->confirmed_status }}"
                                        data-date-from="{{ $leaveRequest->confirmed_leave_date_from }}"
                                        data-date-to="{{ $leaveRequest->confirmed_leave_date_to }}">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>
    </div>

    <!-- Edit Leave Request Modal -->
    <div class="modal fade" id="editLeaveRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="editLeaveRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editLeaveForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLeaveRequestModalLabel">Edit Leave Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editLeaveId" name="id">
                        <div class="mb-3">
                            <label for="editConfirmedStatus" class="form-label">Confirmed Status:</label>
                            <select id="editConfirmedStatus" name="confirmed_status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editLeaveDateFrom" class="form-label">Confirmed Leave Date From:</label>
                            <input type="date" id="editLeaveDateFrom" name="confirmed_leave_date_from"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="editLeaveDateTo" class="form-label">Confirmed Leave Date To:</label>
                            <input type="date" id="editLeaveDateTo" name="confirmed_leave_date_to" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/leave-edit.js') }}"></script>

</body>

</html>