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
        Schema::create('expense_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('from_status', ['DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED', 'PAID'])->nullable();
            $table->enum('to_status', ['DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED', 'PAID']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('expense_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_logs');
    }
};
