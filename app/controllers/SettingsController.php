<?php

class SettingsController extends BaseController
{

    // Set encryption key
    public function key()
    {
        $settings = Settings::find(1);
        if(is_null($settings))
        {
            $settings = new Settings;
            $settings->id = 1;
        }
        $settings->key = Input::get('key');
        $settings->save();
        return Response::json(['code' => '0']);
    }

    // Add a new voice command
    public function addVoiceCommand()
    {
        $voiceCommand = VoiceCommand::find(Input::get('name'));
        if(is_null($voiceCommand))
        {
            $voiceCommand = new VoiceCommand;
            $voiceCommand->name = Input::get('name');
            $voiceCommand->order = Input::get('order');
            $voiceCommand->action = Input::get('action');
            $voiceCommand->save();
            return Response::json(['code' => '0']);
        }
        else
        {
            return Response::json(['code' => '1']);
        }
    }

    // Delete a voice command
    public function deleteVoiceCommand()
    {
        $voiceCommand = VoiceCommand::find(Input::get('name'));
        if(is_null($voiceCommand))
        {
            return Response::json(['code' => '1']);
        }
        else
        {
            $voiceCommand->delete();
            return Response::json(['code' => '0']);
        }
    }

    // Get all the voice commands
    public function getVoiceCommands()
    {
        return Response::json(['content' => VoiceCommand::all()]);
    }
}
