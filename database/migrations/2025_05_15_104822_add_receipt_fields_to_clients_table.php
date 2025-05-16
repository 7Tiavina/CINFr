<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('receipt_url')->nullable()->after('stripe_session_id');
            $table->string('charge_id')->nullable()->after('receipt_url');
            $table->string('email')->nullable()->after('charge_id');
            $table->string('card_last4')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'receipt_url',
                'charge_id',
                'email',
                'card_last4'
            ]);
        });
    }
};

