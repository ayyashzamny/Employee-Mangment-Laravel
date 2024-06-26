<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function list()
    {
        return Designation::all();
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'designation_name' => 'required|string|max:255',
        ]);

        // Create a new department
        $designation = new Designation();
        $designation->description = $request->designation_name;
        $designation->save();

        // Return the response
        return response()->json(['success' => true, 'message' => 'Designation added successfully!']);
    }


}
