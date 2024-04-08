<?php

namespace Modules\Airtime\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Phone extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'phone', 'partner_id'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['phone'];

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
    protected $table = "airtime_phone";

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
        $this->fields->bigInteger('phone')->html('text');
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);

    }
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['phone', 'partner_id'];
        $structure['form'] = [
            ['label' => 'Aireime User Phone', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['phone', 'partner_id']],
        ];
        $structure['filter'] = ['phone', 'partner_id'];
        return $structure;
    }

}
