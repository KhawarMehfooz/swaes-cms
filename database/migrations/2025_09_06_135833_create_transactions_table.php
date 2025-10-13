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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->nullable()->unique();
            $table->foreignId('balance_sheet_id')->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('donor_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('type', ['income', 'expense'])->index();
            $table->string('purpose');
            $table->decimal('amount', 15, 2)->index();

            $table->date('dated');

            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
