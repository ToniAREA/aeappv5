<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoBoatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boats')->insert([
            [
                'ref' => 'BOAT001',
                'boat_type' => 'SY',
                'name' => 'Santa María',
                'imo' => 'IMO1234567',
                'mmsi' => '123456789',
                'sat_phone' => '+1234567890',
                'notes' => 'Replica de una carabela de Cristóbal Colón',
                'internal_notes' => 'Revisar el estado de las velas',
                'link' => 'http://example.com/barco1',
                'link_description' => 'Información sobre Santa María',
                'last_use' => Carbon::now(),
                'settings_data' => '{"color":"blue","size":"large"}',
                'public_ip' => '192.168.1.1',
                'coordinates' => 'X: -17.413, Y: 28.123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ref' => 'BOAT002',
                'boat_type' => 'MY',
                'name' => 'Pinta',
                'imo' => 'IMO7654321',
                'mmsi' => '987654321',
                'sat_phone' => '+0987654321',
                'notes' => 'Utilizado para excursiones turísticas',
                'internal_notes' => 'Necesita mantenimiento del casco',
                'link' => 'http://example.com/barco2',
                'link_description' => 'Información sobre Pinta',
                'last_use' => Carbon::now()->subDay(),
                'settings_data' => '{"color":"white","size":"medium"}',
                'public_ip' => '192.168.1.2',
                'coordinates' => 'X: -16.243, Y: 28.456',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ref' => 'BOAT003',
                'boat_type' => 'TT',
                'name' => 'Niña',
                'imo' => null,
                'mmsi' => '234567890',
                'sat_phone' => '+1230984567',
                'notes' => 'Yate de lujo con todas las comodidades',
                'internal_notes' => 'Chequear el sistema de navegación',
                'link' => 'http://example.com/barco3',
                'link_description' => 'Información sobre Niña',
                'last_use' => Carbon::now()->subWeek(),
                'settings_data' => '{"color":"black","size":"small"}',
                'public_ip' => '192.168.1.3',
                'coordinates' => 'X: -15.973, Y: 29.789',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
