<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(VariationTypesTableSeeder::class);
        $this->call(VariationTableSeeder::class);

        //generate dummy records for testing
        if (config('app.dummy_data_enable')) {
            $this->call(AuthorTableSeeder::class);
            $this->call(BookTableSeeder::class);
        }

        Model::reguard();
    }
}
