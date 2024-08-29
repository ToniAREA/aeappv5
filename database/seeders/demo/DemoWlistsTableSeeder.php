<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoWlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wlists')->insert([
            [
                'order_type' => 'request',
                'boat_namecomplete' => 'Voyager',
                'description' => 'Annual engine maintenance and system check',
                'estimated_hours' => 20.5,
                'deadline' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'priority' => 1,
                'proforma_link' => 'http://example.com/proforma/voyager',
                'notes' => 'Customer requested additional propeller inspection',
                'internal_notes' => 'Check spare parts availability',
                'link' => 'http://example.com/orders/voyager-maintenance',
                'link_description' => 'Maintenance order details',
                'last_use' => Carbon::now(),
                'completed_at' => null,
            ],
            [
                'order_type' => 'estimate',
                'boat_namecomplete' => 'Odyssey',
                'description' => 'Hull damage repair',
                'estimated_hours' => 35.0,
                'deadline' => Carbon::now()->addDays(45)->format('Y-m-d'),
                'priority' => 2,
                'proforma_link' => 'http://example.com/proforma/odyssey',
                'notes' => 'Damage occurred during the last storm',
                'internal_notes' => 'Coordinate with insurance company',
                'link' => 'http://example.com/orders/odyssey-repair',
                'link_description' => 'Repair order details',
                'last_use' => Carbon::now(),
                'completed_at' => null,
            ],
            [
                'order_type' => 'work',
                'boat_namecomplete' => 'Endeavour',
                'description' => 'Navigation system upgrade',
                'estimated_hours' => 15.75,
                'deadline' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'priority' => 3,
                'proforma_link' => 'http://example.com/proforma/endeavour',
                'notes' => 'Include the latest software version',
                'internal_notes' => 'Schedule training for the crew',
                'link' => 'http://example.com/orders/endeavour-upgrade',
                'link_description' => 'Upgrade order details',
                'last_use' => Carbon::now(),
                'completed_at' => null,
            ]
        ]);
    }
}
