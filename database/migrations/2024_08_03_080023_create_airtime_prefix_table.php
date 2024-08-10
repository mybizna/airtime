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
        Schema::create('airtime_prefix', function (Blueprint $table) {
            $table->id();

            $table->integer('prefix');
            $table->boolean('published')->default(false);
            $table->foreignId('provider_id')->constrained('airtime_provider')->onDelete('cascade')->nullable()->index('provider_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtime_prefix');
    }
};
