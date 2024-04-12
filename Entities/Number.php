<?php

namespace Modules\Airtime\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Number extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'phone', 'date_used', 'is_used', 'partner_id', 'serial_no'];

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
    protected $table = "airtime_number";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id' )->html('hidden');
        $this->fields->bigInteger('phone')->html('text');
        $this->fields->dateTime('date_used', 6)->nullable()->html('datetime');
        $this->fields->boolean('is_used')->nullable()->html('switch')->default(false);
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);
        $this->fields->bigInteger('serial_no');

    }
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['phone', 'date_used', 'is_used', 'partner_id', 'serial_no'];
        $structure['form'] = [
            ['label' => 'Airtime Number', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['phone', 'date_used', 'is_used', 'partner_id', 'serial_no']],
        ];
        $structure['filter'] = ['phone', 'date_used', 'is_used', 'partner_id', 'serial_no'];
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
