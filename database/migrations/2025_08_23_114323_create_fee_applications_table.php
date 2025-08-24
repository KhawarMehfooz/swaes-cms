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
        Schema::create('fee_applications', function (Blueprint $table) {
            $table->id();

            // Applicant details
            $table->string('name');
            $table->string('father_name');
            $table->string('cnic', 15)->index(); // Format: 00000-0000000-0
            $table->string('mobile_number', 20);
            $table->text('address');

            // Institution details
            $table->string('institution_name');
            $table->string('session');
            $table->enum('fee_type', ['admission_fee', 'annual', 'exam_fee', 'monthly', 'semester'])->nullable();
            $table->decimal('total_fee', 10, 2);
            $table->string('chalan_number');
            $table->string('bank')->nullable();

            // Additional details
            $table->text('additional_details')->nullable();

            // Guardian details
            $table->string('guardian_name')->nullable();
            $table->string('guardian_cnic', 15)->nullable();
            $table->string('guardian_mobile_number', 20)->nullable();
            $table->text('guardian_address')->nullable();
            $table->decimal('guardian_amount', 10, 2)->nullable();

            $table->date('dated');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_applications');
    }
};
