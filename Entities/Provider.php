<?php

namespace Modules\Airtime\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

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
        $this->fields->string('name')->html('text');
        $this->fields->longText('description')->nullable()->html('textarea');
        $this->fields->boolean('published')->html('switch')->default(false);
        $this->fields->string('alias');

    }



}
