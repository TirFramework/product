<?php

namespace Tir\Product\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tir\Crud\Models\CrudModel;

class Product extends CrudModel
{
    use SoftDeletes;

    //Additional trait insert here



    //this function generate option for action select in header panel
    public function getActions()
    {
        $actions = [
            'index' =>
            [
                'published' => trans('crud::panel.publish'),
                'unpublished' => trans('crud::panel.unpublish'),
                'draft' => trans('crud::panel.draft'),
                'delete' => trans('crud::panel.delete'),
            ],

            'trash' =>
            [
                'restore' => trans('panel.restore'),
                'fullDelete' => trans('panel.full_delete'),
            ],
        ];
        return $actions;
    }

    public function getValidation()
    {
        return [
            'name' => 'required',
            'status' => 'required',
            'password' => 'required',
            'email' => "required|unique:users,email,$this->id",
        ];
    }


    public function getFields()
    {
        $fields = [
            [
                'name'       => 'id',
                'type'       => 'text',
                'visible'    => 'io',
            ],
            [
                'name'      => 'name',
                'type'      => 'text',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'email',
                'type'      => 'text',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'mobile',
                'type'      => 'text',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'password',
                'type'      => 'password',
                'visible'   => 'ce',
            ],
            [
                'name'      => 'roles',
                'type'      => 'relationM',
                'relation'  => 'roles',
                'data'      => ['\Tir\Acl\Role','title'],
                'datatable' => ['roles[].title', 'roles.title'],
                'visible'   => 'ice',
            ],
            [
                'name'      => 'type',
                'type'      => 'select',
                'data'      => ['user' => trans('user::panel.user'), 'admin' => trans('user::panel.admin')],
                'visible'   => 'icef'
            ],
            [
                'name'      => 'status',
                'type'      => 'select',
                'data'      => ['enabled' => trans('user::panel.enabled'), 'disabled' => trans('user::panel.disabled')],
                'visible'   => 'icef'
            ],
            [
                'name'      => 'email_verified_at',
                'type'      => 'date',
                'visible'   => 'ice'
            ],



        ];

        return json_decode(json_encode($fields));
    }


}
