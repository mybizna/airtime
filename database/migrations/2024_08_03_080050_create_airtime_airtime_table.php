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
            $table->foreignId('payment_id')->nullable()->constrained('account_payment')->onDelete('set null');
            $table->foreignId('partner_id')->nullable()->constrained('partner_partner')->onDelete('set null');
            $table->dateTime('purchase_date', 6)->nullable();
            $table->foreignId('prefix_id')->nullable()->constrained('airtime_prefix')->onDelete('set null');
            $table->foreignId('provider_id')->nullable()->constrained('airtime_provider')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained('core_country')->onDelete('set null');
            $table->boolean('completed')->nullable()->default(false);
            $table->boolean('successful')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(false);

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
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
