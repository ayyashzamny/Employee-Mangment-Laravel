<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualLeave extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'annual_leaves';

    // The attributes that are mass assignable.
    protected $fillable = [
        'employee_id',
        'year',
        'total_casual_leaves',
        'total_medical_leaves',
        'balance_casual_leaves',
        'balance_medical_leaves',
    ];

    // Define the relationship with the Employee model.
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
