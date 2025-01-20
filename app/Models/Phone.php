<?php
namespace Modules\Airtime\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
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
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->bigInteger('phone');
        $table->unsignedBigInteger('partner_id')->nullable();
    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('partner_id')->references('id')->on('partner_partner')->onDelete('set null');
    }
}
