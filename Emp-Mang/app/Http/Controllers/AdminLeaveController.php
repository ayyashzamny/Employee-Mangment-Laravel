<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class AdminLeaveController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee', 'leaveType')->get();
        return view('admin-leaves.index', compact('leaveRequests'));
    }

    public function show($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('admin-leaves.show', compact('leaveRequest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'confirmed_status' => 'required|string',
            'confirmed_leave_date_from' => 'nullable|date',
            'confirmed_leave_date_to' => 'nullable|date',
        ]);

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Leave request updated successfully.',
            'leaveRequest' => $leaveRequest // Optionally return updated leaveRequest object
        ]);
    }
}
