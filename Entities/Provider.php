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
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['name'];

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
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['name', 'published', 'alias'];
        $structure['form'] = [
            ['label' => 'Airtime Provider Details', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['name', 'alias', 'published']],
            ['label' => 'Airtime Provider Description', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['description']],
        ];
        $structure['filter'] = ['name', 'published', 'alias'];
        return $structure;
    }

    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {
        $rights = parent::rights();

        $rights['staff'] = ['view' => true];
        $rights['registered'] = [];
        $rights['guest'] = [];

        return $rights;
    }
}
