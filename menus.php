<?php

/** @var \Modules\Base\Classes\Fetch\Menus $this */

$this->add_module_info("airtime", [
    'title' => 'Airtime',
    'description' => 'Airtime',
    'icon' => 'fas fa-people-arrows',
    'path' => '/airtime/admin/airtime',
    'class_str' => 'text-primary border-primary',
    'position' => 1,
]);

//$this->add_menu("module", "key", "title","path", "icon", "position");
$this->add_menu("airtime", "airtime", "Airtime", "/airtime/admin/airtime", "fas fa-cogs", 1);
$this->add_menu("airtime", "number", "Number", "/airtime/admin/number", "fas fa-cogs", 1);
$this->add_menu("airtime", "phone", "Phone", "/airtime/admin/phone", "fas fa-cogs", 1);
$this->add_menu("airtime", "prefix", "Prefix", "/airtime/admin/prefix", "fas fa-cogs", 1);
$this->add_menu("airtime", "provider", "Provider", "/airtime/admin/provider", "fas fa-cogs", 1);
