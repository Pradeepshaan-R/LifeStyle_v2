<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use DB;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Super Admin',
            'email' => 'azmeer.sc@gmail.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //2
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Landlord',
            'email' => 'landlord@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //3
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Tenant Admin',
            'email' => 'tenant_admin@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //4
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Manager',
            'email' => 'manager@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //5
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Staff User',
            'email' => 'staff@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //6
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //create user_extras accounts
        foreach (range(1, 6) as $index) {
            DB::table('user_extras')->insert([
                'user_id' => $index,
            ]);
        }

        $this->enableForeignKeys();
    }
}
