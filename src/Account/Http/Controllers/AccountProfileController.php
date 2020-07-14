<?php

namespace Tir\Store\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tir\Store\User\Http\Requests\UpdateProfileRequest;

class AccountProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $my = auth()->user();

        return view(config('crud.front-template').'::public.account.profile.edit', compact('my'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Tir\Store\User\Http\Requests\UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->bcryptPassword($request);

        auth()->user()->update($request->all());

        return back()->withSuccess(trans('account::messages.profile_updated'));
    }

    /**
     * Bcrypt user password.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function bcryptPassword($request)
    {
        if ($request->filled('password')) {
            return $request->merge(['password' => bcrypt($request->password)]);
        }

        unset($request['password']);
    }
}
