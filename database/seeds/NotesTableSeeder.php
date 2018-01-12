<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NotesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
			Note::create([
				'user_id' => $faker->randomElement(['admin','user']),
				'type_id' => $faker->randomElement(Type::lists('id')),
				'title' => $faker->sentence(5),
				'description' => $faker->sentence(100),
				'tags' => $faker->sentence(1)
			]);
		}
	}

}