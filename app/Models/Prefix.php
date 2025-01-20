<?php
namespace Modules\Airtime\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Airtime\Models\Provider;
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

    /**
     * Add relationship to Provider
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->integer('prefix');
        $table->boolean('published')->default(false);
        $table->unsignedBigInteger('provider_id')->nullable();

    }
    public function post_migration(Blueprint $table): void
    {
        $table->foreign('provider_id')->references('id')->on('airtime_provider')->onDelete('set null');
    }
}
