<?php

class DeviceTableSeeder extends Seeder {

	public function run()
	{
		DB::table('devices')->delete();
		Device::create(['name' => 'node-1', 'quick_data' => 'rx43r43rxc34rc43']);
		Device::create(['name' => 'node-2', 'quick_data' => 'asxasxfewdaxcsda']);
		Device::create(['name' => 'node-3', 'quick_data' => 'cdsccsawdescscef']);
		Device::create(['name' => 'node-4', 'quick_data' => 'htthascrvrvdgdfw']);
	}

}
