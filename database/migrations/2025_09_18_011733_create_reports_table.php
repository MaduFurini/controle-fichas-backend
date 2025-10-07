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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('event_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->longText('file');
            $table->date('date');
            $table->timestamps();

            $table->foreign('community_id')->references('id')->on('communities');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
