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
        Schema::create('whatsapp_previews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('header_text'); 
            $table->string('icon_image');  
            $table->json('chat_messages'); 
            $table->string('video');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_previews');
    }
};
