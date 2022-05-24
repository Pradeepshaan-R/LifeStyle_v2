<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class VariationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('variation_types')->insert([
            'title' => "Length",
        ]);

        DB::table('variation_types')->insert([
            'title' => "Size",
        ]);

        DB::table('variation_types')->insert([
            'title' => "Thickness",
        ]);
        
        DB::table('variation_types')->insert([
            'title' => "Color",
        ]);
    }
}
