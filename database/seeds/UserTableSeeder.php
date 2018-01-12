<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		User::truncate();

		User::create([
			'user_id' => 'admin',	'password' => Hash::make('Wg03x8f34'),
			'fname' => 'Kevin', 	'lname' => 'Cainday',
			'dob'  => '1989-01-30',	'position' => 'I.T. Officer 1'
		]);

		User::create([
			'user_id' => 'mac',	'password' => Hash::make('mac'),
			'fname' => 'Mark Anthony', 	'lname' => 'Timario',
			'dob'  => '1999-01-01',	'position' => 'Computer Programmer III'
		]);

		User::create([
			'user_id' => 'mj',	'password' => Hash::make('mj'),
			'fname' => 'Mark Joseph', 	'lname' => 'Pantaleon',
			'dob'  => '1999-01-01',	'position' => 'Computer Programmer III'
		]);

		User::create([
			'user_id' => 'krissy',	'password' => Hash::make('krissy'),
			'fname' => 'Krissel', 	'lname' => 'Marty',
			'dob'  => '1999-01-01',	'position' => 'Computer Programmer III'
		]);

		User::create([
			'user_id' => 'lester',	'password' => Hash::make('lester'),
			'fname' => 'Lester Lou', 	'lname' => 'Reyes',
			'dob'  => '1999-01-01',	'position' => 'Computer Maintenance Technologist I'
		]);

		User::create([
			'user_id' => 'bing',	'password' => Hash::make('bing'),
			'fname' => 'Rubena', 	'lname' => 'Felix',
			'dob'  => '1999-01-01',	'position' => 'Computer Maintenance Technologist I'
		]);

		User::create([
			'user_id' => 'jm',	'password' => Hash::make('jm'),
			'fname' => 'John Mar', 	'lname' => 'Garcia',
			'dob'  => '1999-01-01',	'position' => 'I.T. Officer I'
		]);
	}

}