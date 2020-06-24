<?php

namespace Tir\Store\StoreSetting\Http\Controllers;

use Tir\Setting\Controllers\AdminSettingController;
use Tir\Store\StoreSetting\Entities\StoreSetting;


class AdminStoreSettingController extends AdminSettingController
{
    protected $model = StoreSetting::Class;
    protected $module = 'storefront';
}

