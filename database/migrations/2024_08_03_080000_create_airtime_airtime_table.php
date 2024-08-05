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

            $table->foreignId('phone');
            $table->decimal('amount', 11);
            $table->boolean('paid')->nullable()->default(false);
            $table->foreignId('payment_id')->nullable();
            $table->foreignId('partner_id')->nullable();
            $table->dateTime('purchase_date', 6)->nullable();
            $table->foreignId('prefix_id')->nullable();
            $table->foreignId('provider_id')->nullable();
            $table->foreignId('country_id')->nullable();
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
