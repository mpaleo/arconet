<?php

class UserController extends BaseController
{
    public function login()
    {
        if(Input::get('name') == 'Admin' || Input::get('name') == 'Test')
        {
            Session::put('user', Input::get('name'));
            return Response::json(['code' => '0']);
        }
        else
        {
            return Response::json(['code' => '1']);
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('/');
    }
}
