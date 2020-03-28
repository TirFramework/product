<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\AttributeDescription;

class AdminAttributeDescriptionController extends CrudController
{
    protected $model = AttributeDescription::Class;

}
