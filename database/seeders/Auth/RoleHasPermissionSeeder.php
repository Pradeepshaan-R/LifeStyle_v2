<?php
namespace Database\Seeders\Auth;

use Database\Seeders\Traits\DisableForeignKeys;
use DB;
use JeroenZwart\CsvSeeder\CsvSeeder;
use Schema;

class RoleHasPermissionSeeder extends CsvSeeder
{
    use DisableForeignKeys;

    public function __construct()
    {
        $this->file = '/database/seeders/Auth/role_has_permissions.csv';
        $this->tablename = 'role_has_permissions';
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
        $this->disableForeignKeys();
        DB::disableQueryLog();
        Schema::disableForeignKeyConstraints();
        parent::run();

        Schema::enableForeignKeyConstraints();
        $this->enableForeignKeys();
    }
}
