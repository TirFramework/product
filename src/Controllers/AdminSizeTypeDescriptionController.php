<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\SizeTypeDescription;

class AdminSizeTypeDescriptionController extends CrudController
{
    protected $model = SizeTypeDescription::Class;

}
