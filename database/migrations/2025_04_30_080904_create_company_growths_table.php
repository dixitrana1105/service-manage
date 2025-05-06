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
        Schema::create('company_growths', function (Blueprint $table) {
            $table->id();
            $table->year('year'); // example: 2024
            $table->decimal('revenue', 10, 2); // example: 12.50 (in millions)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_growths');
    }
};
