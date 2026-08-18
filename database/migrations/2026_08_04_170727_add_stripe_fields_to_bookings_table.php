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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('amount_cents')->nullable()->after('payment_method');
            $table->string('currency', 3)->nullable()->after('amount_cents');
            $table->string('stripe_payment_intent_id')->nullable()->after('currency');
            $table->timestamp('paid_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['amount_cents', 'currency', 'stripe_payment_intent_id', 'paid_at']);
        });
    }
};
