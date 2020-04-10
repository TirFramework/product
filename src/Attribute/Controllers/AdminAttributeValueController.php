<?php

namespace Tir\Store\Attribute\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Attribute\Entities\OptionValue;

class AdminAttributeSetController extends CrudController
{
    protected $model = OptionValue::Class;

}
