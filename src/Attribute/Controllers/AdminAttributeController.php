<?php

namespace Tir\Store\Attribute\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Tir\Crud\Controllers\CrudController;
use Tir\Crud\Support\Facades\Crud;
use Tir\Store\Attribute\Entities\Attribute;


class AdminAttributeController extends CrudController
{
    protected $model = Attribute::Class;


    public function saveAdditional(Request $request, $item)
    {
        return $this->saveValues($request->values, $item);
    }



    /**
     * @param array $values
     * @param Attribute $item
     */
    private function saveValues(array $values, Attribute $item)
    {
        $ids = $this->getDeleteCandidates($values, $item);
        if ($ids->isNotEmpty()) {
            $item->values()->whereIn('id', $ids)->delete();
        }

        foreach (Crud::array_reset_index($values) as $index => $value) {
            $item->values()->updateOrCreate(
                ['id' => $value['id']],
                $value + ['position' => $index]
            );
        }
    }

    private function getDeleteCandidates(array $values, $item)
    {
        return $item->values()
            ->pluck('id')
            ->diff(Arr::pluck($values, 'id'));
    }


    public function values($id)
    {
        return $this->model::find($id)->values()->get()->toJson();
    }


}
