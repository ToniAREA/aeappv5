<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener el último ID en la tabla antigua de wlogs
        $lastIdOld = DB::connection('mysql_old')->table('wlogs')->orderBy('id', 'desc')->first()->id;
        $this->command->line("{$lastIdOld} is the last ID in old database");

        // Obtener todos los registros de la tabla antigua de wlogs
        $oldwlogs = DB::connection('mysql_old')->table('wlogs')->get();
        $this->command->line("{$oldwlogs->count()} records found in old database");

        // Contar cuántos registros ya existen en la nueva base de datos
        $count = DB::table('wlogs')->count();
        $this->command->line("{$count} records found in new database");

        if ($count > 0) {
            $lastId = DB::table('wlogs')->orderBy('id', 'desc')->first()->id;
            $nextId = $lastId + 1;
            $this->command->line("There are already records in new database, next ID is {$nextId}");
            return;
        } else {
            $this->command->line("There are no records in new database, let's start from 1");
            $nextId = 1;
        }

        // Insertar registros en la nueva base de datos
        for ($i = 1; $i <= $lastIdOld; $i++) {
            $wlogs = $oldwlogs->where('id', $i)->first();

            if ($wlogs != null) {
                $this->command->line("{$wlogs->id} \t{$wlogs->boat_namecomplete} is gonna be inserted in new database \n\twith created_at: {$wlogs->created_at} and updated_at: {$wlogs->created_at}");
                
                // Lógica para determinar si el registro debe estar marcado como "invoiced" o no
                if ($wlogs->status == 'charged'){
                    $invoiced = 1; // Marcado como facturado
                } else {
                    $invoiced = 0; // No facturado
                }

                // Verificar si 'hours' tiene valor, si no, asignar 0
                $hours = $wlogs->hours ?? 0;

                // Verificar si 'description' tiene valor, si no, asignar un valor por defecto
                $description = $wlogs->description ?? 'No description';

                // Insertar el registro en la nueva base de datos
                DB::table('wlogs')->insert([
                    'boat_namecomplete' => $wlogs->boat_namecomplete,
                    'description' => $description, // Asegurar valor por defecto en 'description'
                    'date' => $wlogs->date,
                    'hours' => $hours, // Asegurar que 'hours' no sea null
                    'notes' => $wlogs->materials, // Cambia 'materials' si tiene otro nombre en la nueva db
                    'created_at' => $wlogs->created_at,
                    'updated_at' => $wlogs->created_at,
                    'wlist_id' => $wlogs->wlist_id,
                    'marina_id' => $wlogs->marina_id,
                    'invoiced_line' => $invoiced, // Marcado o no como facturado
                    'employee_id' => $wlogs->employee_id, // Agregar employee_id
                ]);
            } else {
                // Si no hay datos, insertar un registro vacío
                $this->command->line("<error>{$i} is null</error>");

                DB::table('wlogs')->insert([
                    'boat_namecomplete' => '----',
                    'description' => 'No description', // Asegurar un valor por defecto en 'description'
                    'date' => '2023-09-01',
                    'hours' => 0, // Asegurar valor por defecto de 0 en 'hours'
                    'notes' => '----',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'wlist_id' => null,
                    'marina_id' => null,
                    'invoiced_line' => 0, // No facturado
                    'employee_id' => null, // Valor nulo para registros vacíos
                ]);
                $this->command->line("<info>BLANK {$i} is inserted in new database</info>");
            }
        }
    }
}