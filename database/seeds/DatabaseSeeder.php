<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;

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

        //*********************** VARIABLES *****************************//

        $number_of_records = 20;
        $password = "123456";

        //*********************** CREATE USERS *****************************//

        for ($user_id = 1; $user_id <= $number_of_records; $user_id++)
        {
            if($user_id === 1)
            {
                DB::table('users')->insert([
                    'name' => 'Krystian Bondaruk',
                    'email' => 'bondar91@gmail.com',
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
                        $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                        break;
                    case 'f':
                        $name = $faker->firstNameFemale . " " . $faker->lastNameFemale;
                        $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                        break;
                }

                DB::table('users')->insert([
                    'name' => $name,
                    'email' => str_replace('-','', str_slug($name)) . '@' . $faker->safeEmailDomain,
                    'sex' => $sex,
                    'avatar' => $avatar,
                    'password' => bcrypt($password),
                ]);

            }

            //*********************** CREATE FRIENDSHIP *****************************//
            for ($i = 1; $i <= $faker->numberBetween($min = 1, $max = $number_of_records-1); $i++)
            {
                $friend_id = $faker->numberBetween($min = 1, $max = $number_of_records);

                $friendship = Friend::where([
                    'user_id' => $user_id,
                    'friend_id' => $friend_id,
                ])->orWhere([
                    'user_id' => $friend_id,
                    'friend_id' => $user_id,
                ])->exists();

                if (!$friendship)
                {
                    DB::table('friends')->insert([
                        'user_id' => $user_id,
                        'friend_id' => $friend_id,
                        'accepted' => 1,
                        'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    ]);
                }
            }
        }
    }
}
