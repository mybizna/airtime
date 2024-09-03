<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;

class Provider extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'name', 'description', 'published', 'alias'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "airtime_provider";
}
