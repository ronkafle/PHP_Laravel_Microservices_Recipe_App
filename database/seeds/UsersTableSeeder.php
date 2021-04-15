<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create(['name'      => 'John Doe',
					  'email'     => 'admin@recipe_app.com',
					  'password'  => bcrypt('secret'),
					  'api_token' => hash('sha256', 'vcBkpKAH3XbDk')]);
	}
}
