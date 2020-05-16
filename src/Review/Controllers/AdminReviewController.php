<?php

namespace Tir\Store\Review\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Review\Entities\Review;


class AdminReviewController extends CrudController
{
    protected $model = Review::Class;


}
