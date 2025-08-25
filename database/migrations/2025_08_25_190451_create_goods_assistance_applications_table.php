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
        Schema::create('goods_assistance_applications', function (Blueprint $table) {
            $table->id();
            $table->longText('goods_details');
            $table->longText('payment_details');
            $table->string('cheque_and_bill_number');
            $table->string('receiver_name');
            $table->string('receiver_cnic', 15);
            $table->string('receiver_mobile_number', 20);

             // Application details
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
        Schema::dropIfExists('goods_assistance_applications');
    }
};
