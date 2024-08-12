<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;

class Prefix extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'prefix', 'published', 'provider_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "airtime_prefix";

}
