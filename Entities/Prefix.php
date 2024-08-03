<?php

namespace Modules\Airtime\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

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
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id')->html('hidden');
        $this->fields->integer('prefix')->html('text');
        $this->fields->boolean('published')->html('switch')->default(false);
        $this->fields->bigInteger('provider_id')->nullable()->html('recordpicker')->relation(['airtime', 'provider']);

    }

 
}
