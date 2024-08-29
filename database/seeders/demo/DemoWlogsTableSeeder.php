<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoWlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wlogs')->insert([
            [
                'boat_namecomplete' => 'Serenity',
                'date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'description' => 'Routine maintenance of navigation systems and software update.',
                'hours' => 4.5,
                'hourly_rate' => 85.00,
                'travel_cost_included' => true,
                'total_travel_cost' => 20.00,
                'total_access_cost' => 50.00,
                'wlist_finished' => true,
                'invoiced_line' => false,
                'notes' => 'Client requested a follow-up session for system briefing.',
                'internal_notes' => 'Ensure software licenses are updated.',
            ],
            [
                'boat_namecomplete' => 'Voyager',
                'date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'description' => 'Emergency repair of hull damage and water pump replacement.',
                'hours' => 8.25,
                'hourly_rate' => 95.00,
                'travel_cost_included' => false,
                'total_travel_cost' => 0.00,
                'total_access_cost' => 100.00,
                'wlist_finished' => true,
                'invoiced_line' => false,
                'notes' => 'Additional inspection recommended for next dock visit.',
                'internal_notes' => 'Check inventory for replacement parts.',
            ],
            [
                'boat_namecomplete' => 'Serenity',
                'date' => Carbon::now()->format('Y-m-d'),
                'description' => 'Scheduled inspection of engine and fuel system.',
                'hours' => 6.75,
                'hourly_rate' => 85.00,
                'travel_cost_included' => true,
                'total_travel_cost' => 15.00,
                'total_access_cost' => 75.00,
                'wlist_finished' => false,
                'invoiced_line' => false,
                'notes' => 'Client requested a follow-up session for system briefing.',
                'internal_notes' => 'Ensure software licenses are updated.',
            ],// Third entry
            [
                'boat_namecomplete' => 'Endurance',
                'date' => Carbon::now()->subDays(7)->format('Y-m-d'),
                'description' => 'Installation of new sonar equipment and system testing.',
                'hours' => 5.75,
                'hourly_rate' => 90.00,
                'travel_cost_included' => true,
                'total_travel_cost' => 30.00,
                'total_access_cost' => 0.00, // Assume direct access, no extra cost
                'wlist_finished' => true,
                'invoiced_line' => true,
                'notes' => 'Client expressed interest in future radar system upgrades.',
                'internal_notes' => 'Scheduled a demo for the latest radar tech next month.',
            ],

            // Fourth entry
            [
                'boat_namecomplete' => 'Discovery',
                'date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'description' => 'General electrical system maintenance and battery check.',
                'hours' => 3.50,
                'hourly_rate' => 85.00,
                'travel_cost_included' => false,
                'total_travel_cost' => 0.00,
                'total_access_cost' => 25.00, // Some access cost for specialized equipment
                'wlist_finished' => false,
                'invoiced_line' => false,
                'notes' => 'Battery replacement recommended within the next 6 months.',
                'internal_notes' => 'Check stock for compatible batteries.',
            ],

            // Fifth entry
            [
                'boat_namecomplete' => 'Pioneer',
                'date' => Carbon::now()->format('Y-m-d'),
                'description' => 'Upgrade to LED lighting and efficiency audit.',
                'hours' => 6.25,
                'hourly_rate' => 100.00,
                'travel_cost_included' => true,
                'total_travel_cost' => 15.00,
                'total_access_cost' => 0.00, // No extra access cost
                'wlist_finished' => true,
                'invoiced_line' => true,
                'notes' => 'Client is very satisfied with the lighting improvement.',
                'internal_notes' => 'Consider suggesting LED upgrades to other clients for energy efficiency improvements.',
            ],
        ]);
    }
}
