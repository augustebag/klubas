<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Auguste',
            'email' => 'abagdzeviciute@gmail.com',
            'password' => Hash::make('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'liepa',
            'email' => 'liepa@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $title = ['Pirmas', 'Antras', 'Trecias', 'Ketvirtas', 'Penktas', 'Sestas', 'Septintas'];
        foreach(range(1, 100) as $_) {

            DB::table('reservoirs')->insert([
                'title' => $title[rand(0, count($title) -1)], 
                'area' => rand(10, 50),
                'photo' => rand(0, 2) ? $faker->imageUrl(200, 300) : null,
                'about' => $faker->realText(300, 5),
            ]);
        }

        $live = ['Alex', 'Sara', 'Bette', 'Sugar', 'Blue', 'Cody', 'Magic'];
        foreach(range(1, 100) as $_) {

            DB::table('members')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'live' => $live[rand(0, count($live) -1)],
                'experience' => rand(1, 100000),
                'registered' => rand(1, 100000),
                'reservoir_id' => rand(1, 20) 
            ]);
        }
    }
}
