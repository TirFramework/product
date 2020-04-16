<?php

namespace Tir\Store\Attribute\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Attribute\Entities\AttributeValue;

class AdminAttributeValueController extends CrudController
{
    protected $model = AttributeValue::Class;

}
