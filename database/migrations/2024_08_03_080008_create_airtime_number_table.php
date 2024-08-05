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
        Schema::create('airtime_number', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('phone');
            $table->dateTime('date_used', 6)->nullable();
            $table->boolean('is_used')->nullable()->default(false);
            $table->integer('partner_id')->nullable();
            $table->bigInteger('serial_no');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtime_number');
    }
};
