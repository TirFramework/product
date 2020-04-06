<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\OptionDescription;

class AdminOptionDescriptionController extends CrudController
{
    protected $model = OptionDescription::Class;

}
