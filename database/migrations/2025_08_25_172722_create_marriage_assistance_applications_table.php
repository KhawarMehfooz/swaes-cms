<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marriage_assistance_applications', function (Blueprint $table) {
            $table->id();

            // Guardian / Applicant details
            $table->string('applicant_name');
            $table->string('applicant_father_or_husband_name')->nullable();
            $table->text('applicant_address');
            $table->string('applicant_cnic', 15);
            $table->string('applicant_mobile_number', 20);
            $table->string('applicant_occupation')->nullable();
            $table->decimal('applicant_family_members');

            // Bride details
            $table->string('bride_name');
            $table->string('bride_education');
            $table->string('bride_cnic', 15);
            $table->string('bride_occupation');
            $table->date('bride_dob');
            $table->string('bride_marriage_status');
            $table->text('bride_needs');

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
        Schema::dropIfExists('marriage_assistance_applications');
    }
};
