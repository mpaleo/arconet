<?php

class DeviceController extends BaseController
{
    public function add()
    {
        $device = Device::find(Input::get('name'));
        if(is_null($device))
        {
            $device = new Device;
            $device->name = Input::get('name');
            $device->save();
            return Response::json(['code' => '0']);
        }
        else
        {
            return Response::json(['code' => '1']);
        }
    }

    public function delete()
    {
        $device = Device::find(Input::get('name'));
        if(is_null($device))
        {
            return Response::json(['code' => '1']);
        }
        else
        {
            $device->delete();
            return Response::json(['code' => '0']);
        }
    }

    public function connectivity()
    {
        $device = Device::find(Input::get('name'));
        if(is_null($device))
        {
            return Response::json(['code' => '1']);
        }
        else
        {
            $device->ip = ip2long(Input::get('ip'));
            $device->port = Input::get('port');
            $device->save();
            return Response::json(['code' => '0']);
        }
    }

    public function quickData()
    {
        $device = Device::find(Input::get('name'));
        return Response::json(['code' => '0', 'content' => $device->quick_data]);
    }

    public function sharedData()
    {
        $shared_data = SharedData::where('tag', '=', Input::get('tag'))->get();
        return Response::json(['code' => '0', 'content' => $shared_data]);
    }

    public function deviceData()
    {
        $device_data = DeviceData::where('device_name', '=', Input::get('name'))->get();
        return Response::json(['code' => '0', 'content' => $device_data]);
    }

}
