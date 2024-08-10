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
        Schema::create('airtime_phone', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('phone');
            $table->foreignId('partner_id')->constrained('partner_partner')->onDelete('cascade')->nullable()->index('airtime_phone_partner_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtime_phone');
    }
};
