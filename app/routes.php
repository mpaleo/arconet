<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Device
Route::post('/device/add', 'DeviceController@add');
Route::post('/device/delete', 'DeviceController@delete');
Route::post('/device/connectivity', 'DeviceController@connectivity');
Route::post('/device/device-data', 'DeviceController@deviceData');
Route::post('/device/quick-data', 'DeviceController@quickData');
Route::post('/device/shared-data', 'DeviceController@sharedData');


// RTV
Route::post('/rtv/add', 'RTVController@add');
Route::post('/rtv/delete', 'RTVController@delete');
Route::post('/rtv', 'RTVController@getValue');
Route::post('/rtv/notification', 'RTVController@setNotification');


// Settings
Route::post('/settings/key', 'SettingsController@key');
Route::post('/settings/voice-command', 'SettingsController@getVoiceCommands');
Route::post('/settings/voice-command/add', 'SettingsController@addVoiceCommand');
Route::post('/settings/voice-command/delete', 'SettingsController@deleteVoiceCommand');


// Terminal
Route::post('/terminal/selectDevice', 'TerminalController@selectDevice');
Route::post('/terminal/sendCommand', 'TerminalController@sendCommand');


// Queues
Route::get('/queue/test-1', 'QueueController@testQueueOne');
Route::get('/queue/test-2/{delay}', 'QueueController@testQueueTwo');


// API
Route::get('/api/device-data/{device}/{tag}/{value}', 'ApiController@setDeviceData');
Route::get('/api/quick-data/{device}/{value}', 'ApiController@setQuickData');
Route::get('/api/shared-data/{tag}/{value}', 'ApiController@setSharedData');
Route::get('/api/rtv/{name}/{value}', 'ApiController@setRTVValue');


// App access
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@login']);
Route::get('/logout', 'UserController@logout');


// Dashboard
Route::get('/', 'AppController@showDashboard');
