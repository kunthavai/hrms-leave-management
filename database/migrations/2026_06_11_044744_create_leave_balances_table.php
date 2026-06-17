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
        Schema::create('leave_balances', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('leave_type_id')
                ->constrained()
                ->restrictOnDelete();

            $table->decimal('allocated_days', 5, 2)->default(0);
            $table->decimal('availed_days', 5, 2)->default(0);
            $table->decimal('balance_days', 5, 2)->default(0);
            $table->tinyInteger('status')->default(1);  
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['user_id', 'leave_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
