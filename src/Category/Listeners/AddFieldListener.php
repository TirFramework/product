<?php

namespace Tir\Store\Category\Listeners;


use Tir\Crud\Events\PrepareFieldsEvent;


class AddFieldListener
{

    private $crud;

    public function handle()
    {

        $this->crud = resolve('Crud');

        if ($this->crud->name == 'menuItem') {
            $this->addNewFields();
        }

    }

    private function addNewFields()
    {
        $fields = $this->crud->fields;

        $newFields = (object)[
            'name'     => 'category_id',
            'type'     => 'relation',
            'relation' => ['category', 'name'],
            'visible'  => 'ce'
        ];
        array_push($fields{0}->tabs{0}->fields, $newFields);

    }
}
      