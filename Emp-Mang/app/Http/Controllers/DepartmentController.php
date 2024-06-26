<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function list()
    {
        return Department::all();
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'department_name' => 'required|string|max:255',
        ]);

        // Create a new department
        $department = new Department();
        $department->description = $request->department_name;
        $department->save();

        return response()->json(['success' => true, 'message' => 'Department added successfully!']);
    }


}
