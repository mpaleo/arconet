<?php

class TerminalController extends BaseController
{

    public function sendCommand()
    {
        //Device AJAX data
        $targetDevice = Input::get('dev');
        $sendEncrypted = Input::get('se');

        $command = substr(Input::get('cmd'), 0, strpos(Input::get('cmd'), ':'));
        $commandToSend = Input::get('cmd');
        $parameters = true;
        if($command == false)
        {
            $command = Input::get('cmd');
            $parameters = false;
        }

        //RC4 encryption
        $encrypt = function($key, $command)
        {
            $td = mcrypt_module_open('arcfour', '' , 'stream', '');
            mcrypt_generic_init($td, $key, null);
            $encrypted = mcrypt_generic($td, $command);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            return $encrypted;
        };

        //Parse http headers
        $parseHttpHeaders = function($headers = false)
        {
            if($headers === false)
            {
                return false;
            }
            $headers = str_replace("\r", "", $headers);
            $headers = explode("\n",$headers);
            foreach($headers as $value)
            {
                $header = explode(": ",$value);
                if($header[0] && !isset($header[1]))
                {
                    $headerdata['status'] = $header[0];
                }
                else if($header[0] && $header[1])
                {
                    $headerdata[$header[0]] = $header[1];
                }
            }
            if(array_key_exists('arduinoValue',$headerdata))
            {
            	return $headerdata['arduinoValue'];
            }
            else
            {
            	return false;
            }
        };

        //Show device connectivity
        if($command == 'showIP')
        {
            if($parameters == false)
            {
                $device = Device::find($targetDevice);
                if(is_null($device))
                {
                    return Response::json(['content' => 'The device does not exist']);
                }
                else
                {
                    return Response::json(['content' => $device->name.' connectivity = '.long2ip($device->ip).':'.$device->port]);
                }
            }
            else
            {
                return Response::json(['content' => 'Wrong parameters']);
            }
        }

        //Send command
        else
        {
            $device = Device::find($targetDevice);
            if(is_null($device))
            {
                return Response::json(['content' => 'The device does not exist']);
            }
            else
            {
                if($sendEncrypted == 'true')
                {
                    $settings = Settings::find(1);
                    if(is_null($settings))
                    {
                        return Response::json(['content' => 'To send encrypted data, you must first set a key']);
                    }
                    else
                    {
                        $commandToSend = base64_encode($encrypt($settings->key, $commandToSend));
                    }
                }

                $curl = curl_init();
                curl_setopt_array($curl,
                [
                    CURLOPT_URL => 'http://'.long2ip($device->ip).':'.$device->port.'/?'.$commandToSend,
                    CURLOPT_CONNECTTIMEOUT => 5,
                    CURLOPT_TIMEOUT => 5,
                    CURLOPT_HEADER => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_NOBODY => false
                ]);
                $response = curl_exec($curl);
                $curlError = false;
                if(curl_errno($curl))
                {
                    if(curl_errno($curl) == 6 || curl_errno($curl) == 7 || curl_errno($curl) == 28)
                    {
                        $curlError = true;
                    }
                }
                curl_close($curl);
                if($curlError)
                {
                    return Response::json(['content' => 'Failed to send the command']);
                }
                else
                {
                    $httpHeaderValue = $parseHttpHeaders($response);
                    if($httpHeaderValue == false)
                    {
                        return Response::json(['content' => 'Command sent']);
                    }
                    else
                    {
                        return Response::json(['content' => 'Device response: '.$httpHeaderValue]);
                    }
                }
            }
        }
    }

    //Select device
    public function selectDevice()
    {
        $device = Device::find(Input::get('dev'));
        if(is_null($device))
        {
            return Response::json(['code' => '1']);
        }
        else
        {
            return Response::json(['code' => '0']);
        }
    }

}
