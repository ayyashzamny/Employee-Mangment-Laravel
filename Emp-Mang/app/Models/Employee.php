<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'First_Name',
        'Last_Name',
        'Full_Name',
        'NIC',
        'Gender',
        'Contact_no1',
        'Contact_no2',
        'Address',
        'Active_Status',
        'Permenent_date',
        'department_id',
        'designation_id',
        'Email',
        'Password',
    ];

    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relationship with Designation
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
