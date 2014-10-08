<?php

class ApiController extends BaseController
{

    public function setQuickData($device, $value)
    {
        $device = Device::find($device);
        if(!is_null($device))
        {
            $device->quick_data = $value;
            $device->save();
        }
    }

    public function setDeviceData($device, $tag, $value)
    {
        $checkDevice = Device::find($device);
        if(!is_null($checkDevice))
        {
            $device_data = new DeviceData;
            $device_data->device_name = $device;
            $device_data->tag = $tag;
            $device_data->value = $value;
            $device_data->date = date('Y-m-d H:i:s');
            $device_data->save();
        }
    }

    public function setSharedData($tag, $value)
    {
        $shared_data = new SharedData;
        $shared_data->tag = $tag;
        $shared_data->value = $value;
        $shared_data->date = date('Y-m-d H:i:s');
        $shared_data->save();
    }

    public function setRTVValue($name, $value)
    {
        $rtv = RTV::find($name);
        if(!is_null($rtv))
        {
            if(($rtv->min != 0 && $rtv->max != 0) && ($value < $rtv->min || $value > $rtv->max))
            {
                //Send email notification
                Mail::send('emails.notification', ['rtv' => $rtv, 'value' => $value], function($message)
                {
                    $message->from('test-admin@mail', '[Project name]');
                    $message->to('test-user@mail', 'User')->subject('RTV Notification');
                });
            }
            $rtv->value = $value;
            $rtv->save();
        }
    }

}
