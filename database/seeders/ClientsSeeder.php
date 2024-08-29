<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldClients = DB::connection('mysql_old')->table('clients')->get();

        //get last id in oldClients array
        $last_id = $oldClients->last()->id;
        $last_id++;

        // Insertar los datos en la tabla destino de la nueva base de datos
        for ($i = 1; $i < $last_id; $i++) {

            //find client with $i in $oldClients array
            $client = $oldClients->where('id', $i)->first();
            // if $client is null, make a dummy client with id $i and name 'empty client' 
            if ($client == null) {
                $client = (object) [
                    'has_active_vip_plan' => false,
                    'has_active_maintenance_plan' => false,
                    'defaulter' => false,
                    'ref' => '',
                    'name' => '------',
                    'lastname' => '',
                    'vat' => '',
                    'address' => '',
                    'country' => '',
                    'telephone' => '',
                    'mobile' => '',
                    'email' => '',
                    'notes' => '',
                    'internal_notes' => '',
                    'coordinates' => '',
                    'link_a' => '',
                    'link_a_description' => '',
                    'link_b' => '',
                    'link_b_description' => '',
                    'last_use' => Carbon::now(),
                ];

                
                DB::table('clients')->insert([
                    'has_active_vip_plan' => false,
                    'has_active_maintenance_plan' => false,
                    'defaulter' => $client->defaulter,
                    'ref' => '',
                    'name' => $client->name,
                    'lastname' => $client->lastname,
                    'vat' => $client->vat,
                    'address' => $client->address,
                    'country' => $client->country,
                    'telephone' => $client->phone ?? '',
                    'mobile' => $client->mobile,
                    'email' => $client->email,
                    'notes' => $client->notes,
                    'internal_notes' => $client->internalnotes ?? '',
                    'coordinates' => $client->coordinates ?? '',
                    'link_a' => $client->link_fd ?? '',
                    'link_a_description' => 'FacturaDirecta',
                    'link_b' => '',
                    'link_b_description' => '',
                    'last_use' => Carbon::now(),
                ]);
            } else {
                //check that $i is the same as $client->id
                if ($i != $client->id) {
                    $this->command->line("Error: {$i} is not the same as {$client->id}");
                } else {
                    $this->command->line("{$i} is the same as {$client->id}");
                    print_r($client);
                    DB::table('clients')->insert([
                    'has_active_vip_plan' => false,
                    'has_active_maintenance_plan' => false,
                    'defaulter' => $client->defaulter,
                    'ref' => '',
                    'name' => $client->name,
                    'lastname' => $client->lastname,
                    'vat' => $client->vat,
                    'address' => $client->address,
                    'country' => $client->country,
                    'telephone' => $client->phone ?? '',
                    'mobile' => $client->mobile,
                    'email' => $client->email,
                    'notes' => $client->notes,
                    'internal_notes' => $client->internalnotes ?? '',
                    'coordinates' => $client->coordinates,
                    'link_a' => $client->link_fd ?? '',
                    'link_a_description' => 'FacturaDirecta',
                    'link_b' => '',
                    'link_b_description' => '',
                    'last_use' => Carbon::now(),
                ]);
                }
            }
        }
    }
}
