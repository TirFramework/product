<?php

namespace Tir\Store\Transaction\Http\Controllers;



use Tir\Crud\Controllers\CrudController;
use Tir\Store\Transaction\Entities\Transaction;

class AdminTransactionController extends CrudController
{
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Transaction::class;


}
