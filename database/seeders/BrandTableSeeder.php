<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'title' => "Armour",
        ]);
        DB::table('brands')->insert([
            'title' => "Colorup",
        ]);
        
        DB::table('brands')->insert([
            'title' => "El Toro",
        ]);
        DB::table('brands')->insert([
            'title' => "Rhino",
        ]);
        DB::table('brands')->insert([
            'title' => "Supermet",
        ]);
    }
}
