<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;

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

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
