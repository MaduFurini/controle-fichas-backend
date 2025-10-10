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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->string('name');
            $table->string('code');
            $table->string('email')->unique();
            $table->longText('password');
            $table->string('recovery_code')->nullable();
            $table->enum('access_type', ['general_admin', 'parish_admin', 'parish_community', 'operator', 'unknown'])->default('unknown');
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();

            $table->foreign('community_id')->references('id')->on('communities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
