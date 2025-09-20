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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('session_id');
            $table->string('code');
            $table->float('total_value');
            $table->date('date');
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();

            $table->foreign('community_id')->references('id')->on('communities');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('session_id')->references('id')->on('sessions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
