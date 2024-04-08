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
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['prefix'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = [];

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
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['prefix', 'published', 'provider_id'];
        $structure['form'] = [
            ['label' => 'Airtime Prefix', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['prefix', 'published', 'provider_id']],
        ];
        $structure['filter'] = ['prefix', 'published', 'provider_id'];
        return $structure;
    }

}
