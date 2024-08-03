<?php

namespace Modules\Airtime\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Airtime extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'phone', 'amount', 'paid', 'payment_id', 'partner_id', 'purchase_date', 'prefix_id', 'provider_id', 'country_id', 'completed', 'successful', 'status'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "airtime_airtime";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id');
        $this->fields->bigInteger('phone');
        $this->fields->decimal('amount', 11);
        $this->fields->boolean('paid')->nullable()->html('switch')->default(false);
        $this->fields->bigInteger('payment_id')->nullable()->html('recordpicker')->relation(['account', 'invoice']);
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);
        $this->fields->dateTime('purchase_date', 6)->nullable()->html('datetime');
        $this->fields->bigInteger('prefix_id')->nullable()->html('recordpicker')->relation(['airtime', 'prefix']);
        $this->fields->bigInteger('provider_id')->nullable()->html('recordpicker')->relation(['airtime', 'provider']);
        $this->fields->bigInteger('country_id')->nullable()->html('recordpicker')->relation(['airtime', 'country']);
        $this->fields->boolean('completed')->nullable()->html('switch')->default(false);
        $this->fields->boolean('successful')->nullable()->html('switch')->default(false);
        $this->fields->boolean('status')->nullable()->html('switch')->default(false);

    }
  

  
}
