<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $faker = Faker::create('pl_PL');

        $number_of_records = 20;
        $password = "123456";

        for ($i = 1; $i <= $number_of_records; $i++)
        {
            if($i === 1)
            {
                DB::table('users')->insert([
                    'name' => "Krystian Bondaruk",
                    'email' => str_replace('-','', str_slug('$faker->safeEmailDomain')),
                    'sex' => 'm',
                    'password' => bcrypt($password),
                ]);
            }
            else
            {
                $sex = $faker->randomElement(['m', 'f']);
                switch ($sex)
                {
                    case 'm':
                        $name = $faker->firstNameMale . " " . $faker->lastNameMale;
                        break;
                    case 'f':
                        $name = $faker->firstNameFemale . " " . $faker->lastNameFemale;
                        break;
                }

                DB::table('users')->insert([
                    'name' => $name,
                    'email' => str_replace('-','', str_slug($name)) . '@' . $faker->safeEmailDomain,
                    'sex' => $sex,
                    'password' => bcrypt($password),
                ]);

            }
        }
    }
}
