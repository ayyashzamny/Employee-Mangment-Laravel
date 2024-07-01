<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AnnualLeave;
use DateTime;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $designations = Designation::all();
        return view('employees.create', compact('departments', 'designations'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'full_name' => 'required|string|max:45',
            'nic' => 'required|string|max:45',
            'gender' => 'required|string|max:45',
            'contact_no1' => 'required|string|max:45',
            'contact_no2' => 'nullable|string|max:45',
            'address' => 'required|string|max:945',
            'active_status' => 'required|string|max:45',
            'permanent_date' => 'required|date|date_format:Y-m-d',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'email' => 'required|email|max:45|unique:employees,email',
            'password' => 'required|string|max:45',
            'casual_leave' => 'required|integer',
            'medical_leave' => 'required|integer',

        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new Employee instance and assign attributes
            $employee = new Employee();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->full_name = $request->full_name;
            $employee->nic = $request->nic;
            $employee->gender = $request->gender;
            $employee->contact_no1 = $request->contact_no1;
            $employee->contact_no2 = $request->contact_no2;
            $employee->address = $request->address;
            $employee->active_status = $request->active_status;
            $employee->permenent_date = $request->permanent_date;
            $employee->department_id = $request->department_id;
            $employee->designation_id = $request->designation_id;
            $employee->email = $request->email;
            $employee->password = bcrypt($request->password); // Assuming you store passwords securely (e.g., hashed)

            // Save the employee record
            $employee->save();

            $permanentDate = new DateTime($request->permanent_date);
            $year = $permanentDate->format('Y');


            $medicalLeaves = $request->medical_leave;
            $casualLeaves = $request->casual_leave;


            // Create AnnualLeave instance and assign attributes
            $annualLeave = new AnnualLeave();
            $annualLeave->employee_id = $employee->id;
            $annualLeave->year = $year;
            $annualLeave->total_casual_leaves = $casualLeaves;
            $annualLeave->total_medical_leaves = $medicalLeaves;
            $annualLeave->balance_casual_leaves = $casualLeaves;
            $annualLeave->balance_medical_leaves = $medicalLeaves;

            // Save the annual leave record
            $annualLeave->save();

            // Commit the transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Employee and leave details added successfully.',
                'employee' => $employee,
                'annualLeave' => $annualLeave,
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to add employee and leave details. Error: ' . $e->getMessage(),
            ]);
        }
    }


    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $designations = Designation::all();
        return view('employees.edit', compact('employee', 'departments', 'designations'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'First_Name' => 'required|string|max:45',
            'Last_Name' => 'required|string|max:45',
            'Full_Name' => 'required|string|max:45',
            'NIC' => 'required|string|max:45',
            'Gender' => 'required|string|max:45',
            'Contact_no1' => 'required|string|max:45',
            'Contact_no2' => 'nullable|string|max:45',
            'Address' => 'required|string|max:945',
            'Active_Status' => 'required|string|max:45',
            'Permenent_date' => 'required|string|max:45',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'Email' => 'required|email|max:45',
            'Password' => 'required|string|max:45',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
