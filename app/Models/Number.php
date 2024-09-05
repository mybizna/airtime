<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;

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

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

}
