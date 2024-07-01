<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'leave_type_id',
        'request_leave_date_from',
        'request_leave_date_to',
        'description',
        'confirmed_status',
        'confirm_leave_date_from',
        'confirm_leave_date_to',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(AnnualLeave::class, 'leave_type_id');
    }
}
