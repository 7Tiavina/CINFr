<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('stripe_session_id')->unique();
            $table->string('charge_id')->nullable();
            $table->string('receipt_url')->nullable();
            $table->string('card_last4', 4)->nullable();
            $table->string('email')->nullable();
            $table->integer('amount')->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('status')->nullable();  // “succeeded”, etc.
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
