<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;

class Number extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'phone', 'date_used', 'is_used', 'partner_id', 'serial_no'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "airtime_number";

}
