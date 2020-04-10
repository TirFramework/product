<?php

namespace Tir\Store\Option\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Tir\Crud\Controllers\CrudController;
use Tir\Crud\Support\Helpers\CrudHelper;
use Tir\Store\Option\Entities\Option;


class AdminOptionController extends CrudController
{
    protected $model = Option::Class;



    public function saveAdditional(Request $request, $item)
    {
        return $this->saveValues($request->values, $item);
    }



    /**
     * @param array $values
     * @param Option $item
     */
    private function saveValues(array $values, Option $item)
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

    private function getDeleteCandidates(array $values, $item)
    {
        return $item->values()
            ->pluck('id')
            ->diff(Arr::pluck($values, 'id'));
    }
}
