<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('employees', function (Blueprint $table) {
//             $table->id();
//             $table->string('First_Name');
//             $table->string('Last_Name');
//             $table->string('Full_Name');
//             $table->string('NIC');
//             $table->string('Gender');
//             $table->string('Contact_no1');
//             $table->string('Contact_no2');
//             $table->string('Address');
//             $table->string('Active_Status');
//             $table->string('Permenent_date');

//             // Foreign Keys
//             $table->unsignedBigInteger('department_id');
//             $table->unsignedBigInteger('designation_id');
//             $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
//             $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');

//             $table->string('Email');
//             $table->string('Password');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('employees');
//     }
// };
