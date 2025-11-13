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
        Schema::create('communities', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->id();
            $table->unsignedBigInteger('parish_id')->nullable();
            $table->string('name', 255);
            $table->enum('type', ['parish', 'community', 'unknown'])->default('unknown');
            $table->string('street', 255);
            $table->string('city', 255);
            $table->string('state', 2);
            $table->integer('number')->nullable();
            $table->string('zip_code');
            $table->string('email_responsible');
            $table->string('phone');
            $table->longText('image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
