<?php

namespace Tir\Store\Controllers;

use Tir\Store\Models\SizeType;
use Tir\Crud\Controllers\CrudController;


class AdminSizeTypeController extends CrudController
{
    protected $model = SizeType::Class;
}
