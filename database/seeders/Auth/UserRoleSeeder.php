<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        User::find(1)->assignRole(config('boilerplate.access.role.admin'));
        User::find(2)->assignRole(config('boilerplate.access.role.landlord'));
        User::find(3)->assignRole(config('boilerplate.access.role.tenant_admin'));
        User::find(4)->assignRole(config('boilerplate.access.role.manager'));
        User::find(5)->assignRole(config('boilerplate.access.role.staff'));

        $this->enableForeignKeys();
    }
}
