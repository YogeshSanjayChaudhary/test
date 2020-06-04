<?php

use Illuminate\Database\Seeder;

class channel_master extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 	       //
		DB::table('channel_master')->insert([
			'channel_name' => 'Channel1',
			'channel_description' => '',
			'channel_url' => 'rtmp://3.6.215.234/show',
			'status' => 'active'
		]);	
    }
}
