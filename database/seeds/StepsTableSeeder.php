<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StepsTableSeeder extends Seeder {

	public function run()
	{
		Step::truncate();
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Step::create([
				'note_id' => 1,
				'no' => $index,
				'lead_step' => $faker->randomElement([null,1,2]),
				'title' => $faker->sentence(5),
				'description' => $faker->randomElement([null,$faker->sentence(30)]),
				'user_id' => 'user'
			]);
		}
	}

}