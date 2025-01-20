<?php

namespace Modules\Airtime\Models;

use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->bigInteger('phone');
        $table->dateTime('date_used', 6)->nullable();
        $table->boolean('is_used')->nullable()->default(false);
        $table->unsignedBigInteger('partner_id')->nullable();
        $table->bigInteger('serial_no');

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('partner_id')->references('id')->on('partner_partner')->onDelete('set null');
    }

}
