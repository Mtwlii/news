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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('favicon', 255);
            $table->string('logo', 255);
            $table->string('facebook', 255);
            $table->string('instagram', 255);
            $table->string('twitter', 255);
            $table->string('linkedin', 255);
            $table->string('youtube', 255);
            $table->string('street', 255);
            $table->string('city', 100);
            $table->string('country', 100);
            $table->string('phone', 20);
            $table->string('email', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
