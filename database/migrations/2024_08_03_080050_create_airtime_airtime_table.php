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
        Schema::create('airtime_airtime', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('phone');
            $table->decimal('amount', 11);
            $table->boolean('paid')->nullable()->default(false);
            $table->foreignId('payment_id')->constrained('account_payment')->onDelete('cascade')->nullable()->index('airtime_airtime_payment_id');
            $table->foreignId('partner_id')->constrained('partner_partner')->onDelete('cascade')->nullable()->index('airtime_airtime_partner_id');
            $table->dateTime('purchase_date', 6)->nullable();
            $table->foreignId('prefix_id')->constrained('airtime_prefix')->onDelete('cascade')->nullable()->index('airtime_airtime_prefix_id');
            $table->foreignId('provider_id')->constrained('airtime_provider')->onDelete('cascade')->nullable()->index('airtime_airtime_provider_id');
            $table->foreignId('country_id')->constrained('airtime_country')->onDelete('cascade')->nullable()->index('airtime_airtime_country_id');
            $table->boolean('completed')->nullable()->default(false);
            $table->boolean('successful')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtime_airtime');
    }
};
