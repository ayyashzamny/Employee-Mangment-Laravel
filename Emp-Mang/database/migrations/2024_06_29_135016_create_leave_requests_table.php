<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->integer('leave_type_id');
            $table->date('request_leave_date_from');
            $table->date('request_leave_date_to');
            $table->text('description')->nullable();
            $table->string('confirmed_status')->default('pending');
            $table->date('confirm_leave_date_from')->nullable();
            $table->date('confirm_leave_date_to')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}
