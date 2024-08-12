<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;

class Phone extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'phone', 'partner_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "airtime_phone";

}
