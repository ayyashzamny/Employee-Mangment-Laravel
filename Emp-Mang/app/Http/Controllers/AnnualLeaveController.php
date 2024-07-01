<?php

namespace App\Http\Controllers;

use App\Models\AnnualLeave;
use App\Models\Employee;
use Illuminate\Http\Request;

class AnnualLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annualLeaves = AnnualLeave::with('employee')->get();
        return view('annualLeaves.index', compact('annualLeaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('annualLeaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'year' => 'required|date',
            'total_casual_leaves' => 'required|integer',
            'total_medical_leaves' => 'required|integer',
            'balance_casual_leaves' => 'required|integer',
            'balance_medical_leaves' => 'required|integer',
        ]);

        AnnualLeave::create($request->all());

        return redirect()->route('annualLeaves.index')->with('success', 'Annual Leave created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnualLeave $annualLeave)
    {
        return view('annualLeaves.show', compact('annualLeave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnualLeave $annualLeave)
    {
        $employees = Employee::all();
        return view('annualLeaves.edit', compact('annualLeave', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnnualLeave $annualLeave)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'year' => 'required|date',
            'total_casual_leaves' => 'required|integer',
            'total_medical_leaves' => 'required|integer',
            'balance_casual_leaves' => 'required|integer',
            'balance_medical_leaves' => 'required|integer',
        ]);

        $annualLeave->update($request->all());

        return redirect()->route('annualLeaves.index')->with('success', 'Annual Leave updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnualLeave $annualLeave)
    {
        $annualLeave->delete();

        return redirect()->route('annualLeaves.index')->with('success', 'Annual Leave deleted successfully.');
    }
}
