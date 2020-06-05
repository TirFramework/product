<?php

namespace Tir\Store\Checkout\Services;

use Tir\Setting\Facades\Stg;
use Tir\User\Contracts\Authentication;
use Tir\User\Entities\Role;

class CustomerService
{
    private $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function register($request)
    {
        return tap($this->auth->registerAndActivate($this->getCustomerData($request)), function ($user) {
            //$role = Role::find(Stg::get('customer_role'));

            //$user->roles()->attach($role);
        });
    }

    private function getCustomerData($request)
    {
        return array_merge($request->billing, [
            'email' => $request->customer_email,
            'password' => $request->password,
        ]);
    }
}
