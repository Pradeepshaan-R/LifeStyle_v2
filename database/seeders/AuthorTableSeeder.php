<?php

namespace Database\Seeders;

use DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use Schema;

class AuthorTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeders/authors.csv';
        $this->tablename = 'authors';
        $this->delimiter = ',';
        $this->timestamps = false; //doesn't use created/updated_at fields
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        Schema::disableForeignKeyConstraints();
        parent::run();
        Schema::enableForeignKeyConstraints();
    }
}
