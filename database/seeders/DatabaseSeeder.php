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
            EmployeesSeeder::class,
            MarinasSeeder::class,
            BoatsSeeder::class,
            ClientsSeeder::class,
            BoatClientPivotSeeder::class,
            WlistSeeder::class,
            WlogSeeder::class,
        ]);
    }
}
