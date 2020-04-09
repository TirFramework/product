<?php

namespace Tir\Store\Attribute\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Attribute\Entities\AttributeSet;

class AdminAttributeSetController extends CrudController
{
    protected $model = AttributeSet::Class;

}
