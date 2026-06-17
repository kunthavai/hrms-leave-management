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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('menu_route')->nullable(); // route name or URL
            $table->string('menu_icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // for nested menu
            $table->integer('menu_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('menus')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
