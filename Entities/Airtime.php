<?php

namespace Modules\Airtime\Entities;

use Modules\Base\Entities\BaseModel;

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

}
