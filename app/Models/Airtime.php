<?php
namespace Modules\Airtime\Models;

use Base\Casts\Money;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Account\Models\Payment;
use Modules\Airtime\Models\Prefix;
use Modules\Airtime\Models\Provider;
use Modules\Base\Models\BaseModel;
use Modules\Core\Models\Country;
use Modules\Partner\Models\Partner;

class Airtime extends BaseModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => Money::class, // Use the custom MoneyCast
    ];

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'phone', 'amount', 'paid', 'payment_id', 'partner_id', 'purchase_date', 'prefix_id', 'provider_id', 'country_id', 'completed', 'successful', 'status'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "airtime_airtime";

    /**
     * Add relationship to Prefix
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prefix(): BelongsTo
    {
        return $this->belongsTo(Prefix::class);
    }

    /**
     * Add relationship to Provider
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Add relationship to Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Add relationship to Payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
    public function migration(Blueprint $table): void
    {

        $table->bigInteger('phone');
        $table->integer('amount');
        $table->string('currency')->default('USD');
        $table->boolean('paid')->nullable()->default(false);
        $table->unsignedBigInteger('payment_id')->nullable();
        $table->unsignedBigInteger('partner_id')->nullable();
        $table->dateTime('purchase_date', 6)->nullable();
        $table->unsignedBigInteger('prefix_id')->nullable();
        $table->unsignedBigInteger('provider_id')->nullable();
        $table->unsignedBigInteger('country_id')->nullable();
        $table->boolean('completed')->nullable()->default(false);
        $table->boolean('successful')->nullable()->default(false);
        $table->boolean('status')->nullable()->default(false);

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('payment_id')->references('id')->on('account_payment')->onDelete('set null');
        $table->foreign('partner_id')->references('id')->on('partner_partner')->onDelete('set null');
        $table->foreign('prefix_id')->references('id')->on('airtime_prefix')->onDelete('set null');
        $table->foreign('provider_id')->references('id')->on('airtime_provider')->onDelete('set null');
        $table->foreign('country_id')->references('id')->on('core_country')->onDelete('set null');
    }

}
