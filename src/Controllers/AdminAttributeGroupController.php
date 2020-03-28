<?php

namespace Tir\Store\Controllers;

use Tir\Store\Models\AttributeGroup;
use Tir\Crud\Controllers\CrudController;

class AdminAttributeGroupController extends CrudController
{
    protected $model = AttributeGroup::Class;

}
