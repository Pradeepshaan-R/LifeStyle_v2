<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class VariationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('variations')->insert([
            'variation_type_id' => 1,
            'title' => "6 ft",
        ]);

        DB::table('variations')->insert([
            'variation_type_id' => 1,
            'title' => "12 ft",
        ]);

        DB::table('variations')->insert([
            'variation_type_id' => 2,
            'title' => "Small",
        ]);
        DB::table('variations')->insert([
            'variation_type_id' => 2,
            'title' => "Large",
        ]);
        DB::table('variations')->insert([
            'variation_type_id' => 3,
            'title' => "1 mm",
        ]);
        DB::table('variations')->insert([
            'variation_type_id' => 3,
            'title' => "3 mm",
        ]);
        DB::table('variations')->insert([
            'variation_type_id' => 4,
            'title' => "Gray",
        ]);
        
        DB::table('variations')->insert([
            'variation_type_id' => 4,
            'title' => "Green",
        ]);

        DB::table('variations')->insert([
            'variation_type_id' => 4,
            'title' => "Red",
        ]);
    }
}
