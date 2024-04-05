<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                 'id'    => 2,
                 'title' => 'User',
             ],
             [
                 'id'    => 3,
                 'title' => 'Technician',
             ],
             [
                 'id'    => 4,
                 'title' => 'Client',
             ],
             [
                 'id'    => 5,
                 'title' => 'Captain',
             ],
                [
                    'id'    => 6,
                    'title' => 'Manager',
                ],
                [
                    'id'    => 7,
                    'title' => 'Owner',
                ],
                [
                    'id'    => 8,
                    'title' => 'Employee',
                ],
                [
                    'id'    => 9,
                    'title' => 'Guest',
                ],
                [
                    'id'    => 10,
                    'title' => 'SuperAdmin',
                ],
         ];

        Role::insert($roles);
    }
}
