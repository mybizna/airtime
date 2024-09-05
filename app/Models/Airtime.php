<?php

namespace Modules\Airtime\Models;

use Modules\Account\Models\Payment;
use Modules\Airtime\Models\Prefix;
use Modules\Airtime\Models\Provider;
use Modules\Base\Models\BaseModel;
use Modules\Core\Models\Country;
use Modules\Partner\Models\Partner;

class Airtime extends BaseModel
{

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
    public function prefix()
    {
        return $this->belongsTo(Prefix::class);
    }

    /**
     * Add relationship to Provider
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Add relationship to Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Add relationship to Payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

}
