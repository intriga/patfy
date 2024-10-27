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
        Schema::create('userlogs', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('os');
            $table->string('browser');
            $table->string('country');
            $table->string('city');
            $table->string('isp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userlogs');
    }
};
