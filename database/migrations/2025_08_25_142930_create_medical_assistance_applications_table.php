<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_assistance_applications', function (Blueprint $table) {
            $table->id();

            // Guardian / Applicant details
            $table->string('applicant_name');
            $table->string('applicant_father_or_husband_name')->nullable();
            $table->string('applicant_cnic', 15);
            $table->string('applicant_mobile_number', 20);
            $table->text('applicant_address');
            $table->string('applicant_occupation')->nullable();
            $table->enum('applicant_marital_status', ['single', 'married', 'widowed', 'divorced']);

            // Patient details
            $table->string('patient_name');
            $table->string('patient_cnic', 15);
            $table->string('patient_disease');
            $table->string('hospital_name');
            $table->date('date_of_admission');
            $table->string('doctor_name');
            $table->text('patient_needs');

            // Application details
            $table->date('application_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_assistance_applications');
    }
};
