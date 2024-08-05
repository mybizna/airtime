<?php

namespace Modules\Airtime\Entities;

use Modules\Base\Entities\BaseModel;

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
