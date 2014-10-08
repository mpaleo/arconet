<?php

class AppController extends BaseController
{
	public function showDashboard()
    {
        if(Session::has('user'))
        {
			$devices = Device::all();
			$datasets = SharedData::groupBy('tag')->get();
			$rtvs = RTV::all();
            return View::make('dashboard', compact('devices', 'datasets', 'rtvs'));
        }
        else
        {
            return View::make('login');
        }
    }
}
