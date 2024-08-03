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
 


}
