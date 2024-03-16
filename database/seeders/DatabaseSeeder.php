<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            AssetStatusTableSeeder::class,
            DemoMarinasTableSeeder::class,
            DemoClientsTableSeeder::class,
            DemoBoatsTableSeeder::class,
            DemoToDosTableSeeder::class,
            DemoContactsTableSeeder::class,
            DemoContactCompanyTableSeeder::class,
            DemoWlistsTableSeeder::class,
            DemoWlogsTableSeeder::class,
        ]);
    }
}
