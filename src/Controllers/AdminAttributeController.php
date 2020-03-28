<?php

namespace Tir\Store\Controllers;

use Tir\Store\Models\Attribute;
use Tir\Crud\Controllers\CrudController;

class AdminAttributeController extends CrudController
{
    protected $model = Attribute::Class;

}
