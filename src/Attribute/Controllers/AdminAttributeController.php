<?php

namespace Tir\Store\Attribute\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Tir\Crud\Controllers\CrudController;
use Tir\Crud\Support\Helpers\CrudHelper;
use Tir\Store\Attribute\Entities\Attribute;


class AdminAttributeController extends CrudController
{
    protected $model = Attribute::Class;


    

    public function saveAdditional(Request $request, $item)
    {

    }


    public function updateAdditional(Request $request, $item)
    {
        //return $item;
        //return $request->values;
       return $this->saveValues($request->values, $item);
    }


    public function saveValues($values = [], $item)
    {
        $ids = $this->getDeleteCandidates($values, $item);
        if ($ids->isNotEmpty()) {
            $item->values()->whereIn('id', $ids)->delete();
        }

        foreach (CrudHelper::array_reset_index($values) as $index => $value) {
            $item->values()->updateOrCreate(
                ['id' => $value['id']],
                $value + ['position' => $index]
            );
        }
    }

    private function getDeleteCandidates($values = [], $item)
    {
        return $item->values()
            ->pluck('id')
            ->diff(Arr::pluck($values, 'id'));
    }
}
