<?php

namespace Tir\Store\Controllers;

use Tir\Store\Models\WeightType;
use Tir\Crud\Controllers\CrudController;


class AdminWeightTypeController extends CrudController
{
    protected $model = WeightType::Class;
}
