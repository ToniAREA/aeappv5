<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoMarinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marinas = [
            [
                'name' => 'Sunset Marina',
                'coordinates' => '37.819929,-122.478255',
                'link' => 'http://sunsetmarina.com',
                'link_description' => 'Luxury marina with state-of-the-art facilities.',
                'notes' => 'Known for its beautiful sunset views and excellent customer service.',
                'internal_notes' => 'Prepare for the upcoming regatta event in July.',
                'last_use' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Harbor East',
                'coordinates' => '37.804364,-122.271114',
                'link' => 'http://harboreast.com',
                'link_description' => 'A modern marina with complete amenities for all your boating needs.',
                'notes' => 'Features a full-service boatyard.',
                'internal_notes' => 'Monthly check on environmental compliance.',
                'last_use' => Carbon::now()->subDays(20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bluewater Bay',
                'coordinates' => '36.778261,-119.417932',
                'link' => 'http://bluewaterbay.com',
                'link_description' => 'Your gateway to the great outdoors.',
                'notes' => 'Best for family outings and fishing enthusiasts.',
                'internal_notes' => 'Family day event planning for August.',
                'last_use' => Carbon::now()->subDays(15),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Marina Del Rey',
                'coordinates' => '33.980289,-118.451745',
                'link' => 'http://marinadelrey.com',
                'link_description' => 'One of the largest constructed small boat marinas in the country.',
                'notes' => 'Offers a wide range of recreational and commercial boating services.',
                'internal_notes' => 'Update emergency response plan.',
                'last_use' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pelican Harbor',
                'coordinates' => '34.021122,-118.497466',
                'link' => 'http://pelicanharbor.com',
                'link_description' => 'A peaceful retreat in the heart of the city.',
                'notes' => 'Ideal for kayakers and paddleboarders.',
                'internal_notes' => 'New paddleboarding classes available starting June.',
                'last_use' => Carbon::now()->subDays(30),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('marinas')->insert($marinas);
    }
}
