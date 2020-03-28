<?php

namespace Tir\Store\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Models\AttributeGroupDescription;

class AdminAttributeGroupDescriptionController extends CrudController
{
    protected $model = AttributeGroupDescription::Class;

}
