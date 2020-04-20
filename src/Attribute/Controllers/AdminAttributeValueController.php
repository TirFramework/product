<?php

namespace Tir\Store\Attribute\Controllers;

use Illuminate\Http\Request;
use Tir\Crud\Controllers\CrudController;
use Tir\Store\Attribute\Entities\AttributeValue;

class AdminAttributeValueController extends CrudController
{
    protected $model = AttributeValue::Class;

    public function storeRequestManipulation(Request $request)
    {
        $position = $this->model::select('position')->max('position') + 1;
        $request->merge(['position'=>$position]);
        return $request;
    }


}
