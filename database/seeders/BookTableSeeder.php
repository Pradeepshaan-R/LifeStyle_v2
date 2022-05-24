<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * https://github.com/fzaninotto/Faker
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('books')->insert([
                'status' => $faker->randomElement(['Available', 'Lended','Damaged']),
                'qty' => $faker->numberBetween($min = 1, $max = 10),
                'isbn' => $faker->isbn10,
                'title' => $faker->bs,
                'author_id' => $faker->numberBetween($min = 1, $max = 10),                
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
