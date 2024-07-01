<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\AnnualLeave;

class LeaveRequestController extends Controller
{
    public function create()
    {
        $leaveTypes = AnnualLeave::all();
        return view('leave_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|integer',
            'request_leave_date_from' => 'required|date',
            'request_leave_date_to' => 'required|date|after_or_equal:request_leave_date_from',
            'description' => 'nullable|string',
        ]);

        // Create the leave request
        $leaveRequest = new LeaveRequest();
        $leaveRequest->employee_id = $request->employee_id;
        $leaveRequest->leave_type_id = $request->leave_type_id;
        $leaveRequest->request_leave_date_from = $request->request_leave_date_from;
        $leaveRequest->request_leave_date_to = $request->request_leave_date_to;
        $leaveRequest->description = $request->description;
        $leaveRequest->confirmed_status = 'pending'; // Default status
        $leaveRequest->date = now(); // Assign today's date
        $leaveRequest->save();

        return response()->json([
            'message' => 'Leave request submitted successfully.',
        ], 201);
    }

    public function index()
    {
        $leaveRequests = LeaveRequest::all(); // Adjust this as needed for your application logic
        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function show($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('leave_requests.show', compact('leaveRequest'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'confirmed_status' => 'required|string',
            'confirm_leave_date_from' => 'nullable|date',
            'confirm_leave_date_to' => 'nullable|date',
        ]);

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update($request->all());

        return redirect()->route('leave_requests.index')->with('success', 'Leave request updated successfully.');
    }
}
