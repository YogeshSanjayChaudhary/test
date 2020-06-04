<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call(UsersTableSeeder::class);
		DB::table('user')->insert([
			'username' => 'admin',
			'first_name' => 'Admin',
			'last_name' => 'User',
			'email' => 'temp@gmail.com',
			'password' => bcrypt('Newuser123'),
			'status' => 'active',
			'user_type' => 'admin',
		]);
	}
}
