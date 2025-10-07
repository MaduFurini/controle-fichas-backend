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
        Schema::create('event_products', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('product_id');
            $table->float('price');
            $table->string('observation')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_products');
    }
};
