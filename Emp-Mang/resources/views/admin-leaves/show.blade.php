@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Request Details</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Employee ID: {{ $leaveRequest->employee->id }}</h5>
            <p class="card-text">Date: {{ $leaveRequest->date }}</p>
            <p class="card-text">Leave Type:
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
            <p class="card-text">Request Leave Date From: {{ $leaveRequest->request_leave_date_from }}</p>
            <p class="card-text">Request Leave Date To: {{ $leaveRequest->request_leave_date_to }}</p>
            <p class="card-text">Description: {{ $leaveRequest->description }}</p>
            <p class="card-text">Confirmed Status: {{ $leaveRequest->confirmed_status }}</p>
            <p class="card-text">Confirmed Leave Date From: {{ $leaveRequest->confirmed_leave_date_from }}</p>
            <p class="card-text">Confirmed Leave Date To: {{ $leaveRequest->confirmed_leave_date_to }}</p>
            <a href="{{ route('admin-leaves.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection