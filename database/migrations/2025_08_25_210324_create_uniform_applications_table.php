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
        Schema::create('uniform_applications', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('guardian_name');
            $table->string('guardian_cnic', 15);
            $table->string('guardian_contact_number', 20);
            $table->string('guardian_source_of_income', 20);
            $table->string('student_address', 20);
            $table->string('institution_name', 20);
            $table->string('class', 20);
            $table->json('uniform_details');

            $table->string('scheme_year');
            $table->date('application_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniform_applications');
    }
};
