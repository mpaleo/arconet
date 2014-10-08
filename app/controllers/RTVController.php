<?php

class RTVController extends BaseController
{

    public function add()
    {
        $rtv = RTV::find(Input::get('name'));
        if(is_null($rtv))
        {
            $rtv = new RTV;
            $rtv->name = Input::get('name');
            $rtv->save();
            return Response::json(['code' => '0']);
        }
        else
        {
            return Response::json(['code' => '1']);
        }
    }

    public function delete()
    {
        $rtv = RTV::find(Input::get('name'));
        if(is_null($rtv))
        {
            return Response::json(['code' => '1']);
        }
        else
        {
            $rtv->delete();
            return Response::json(['code' => '0']);
        }
    }

    public function getValue()
    {
        $rtv = RTV::find(Input::get('name'));
        if(is_null($rtv))
        {
            return Response::json(['content' => '0']);
        }
        else
        {
            $notify = '0';
            if(($rtv->min != 0 && $rtv->max != 0) && ($rtv->value < $rtv->min || $rtv->value > $rtv->max))
            {
                $notify = '1';
            }
            return Response::json(['content' => $rtv->value, 'notify' => $notify]);
        }
    }

    public function setNotification()
    {
        $rtv = RTV::find(Input::get('name'));
        if(is_null($rtv))
        {
            return Response::json(['code' => '1']);
        }
        else
        {
            $rtv->min = Input::get('min');
            $rtv->max = Input::get('max');
            $rtv->save();
            return Response::json(['code' => '0']);
        }
    }

}
