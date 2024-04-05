<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('clients')->insert([
            [
            'has_active_vip_plan' => true,
            'has_active_maintenance_plan' => true,
            'defaulter' => false,
            'ref' => 'REF111',
            'name' => 'John',
            'lastname' => 'Doe',
            'vat' => '11111111',
            'address' => '123 Main Street',
            'country' => 'Countryland',
            'telephone' => '123456789',
            'mobile' => '987654321',
            'email' => 'johndoe@example.com',
            'notes' => 'Some notes here',
            'internal_notes' => 'Some internal notes here',
            'coordinates' => 'X: 12345, Y: 67890',
            'link_a' => 'http://examplelinka.com',
            'link_a_description' => 'Example Link A Description',
            'link_b' => 'http://examplelinkb.com',
            'link_b_description' => 'Example Link B Description',
            'last_use' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    [
            'has_active_vip_plan' => false,
            'has_active_maintenance_plan' => true,
            'defaulter' => true,
            'ref' => 'REF222',
            'name' => 'Paul',
            'lastname' => 'Rombos',
            'vat' => '22222222',
            'address' => '123 Main Street',
            'country' => 'Countryland',
            'telephone' => '123456789',
            'mobile' => '987654321',
            'email' => 'paulrombos@example.com',
            'notes' => 'Some notes here',
            'internal_notes' => 'Some internal notes here',
            'coordinates' => 'X: 12345, Y: 67890',
            'link_a' => 'http://examplelinka.com',
            'link_a_description' => 'Example Link A Description',
            'link_b' => 'http://examplelinkb.com',
            'link_b_description' => 'Example Link B Description',
            'last_use' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
    ]);

    }
}
