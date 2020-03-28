<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\WeightTypeDescription;

class AdminWeightTypeDescriptionController extends CrudController
{
    protected $model = WeightTypeDescription::Class;

}
