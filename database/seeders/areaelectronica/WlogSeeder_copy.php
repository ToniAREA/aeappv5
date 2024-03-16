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
        $lastIdOld = DB::connection('mysql_old')->table('wlogs')->orderBy('id', 'desc')->first()->id;
        // get last id in wlogs table at db mysql_old
        $this->command->line("{$lastIdOld} is the last ID in old database");
        // get all records from wlogs table at db mysql_old
        $oldwlogs = DB::connection('mysql_old')->table('wlogs')->get();
        $this->command->line("{$oldwlogs->count()} records found in old database");
        //count registered wlogs in new db
        $count = DB::table('wlogs')->count();
        $this->command->line("{$count} records found in new database");
        if ($count > 0) {
            //get last id in new db
            $lastId = DB::table('wlogs')->orderBy('id', 'desc')->first()->id;
            $nextId = $lastId + 1;
            $this->command->line("There are already records in new database, next ID is {$nextId}");
            return;
        } else {
            $this->command->line("There are no records in new database, let's start from 1");
            $nextId = 1;
        }


        // insert records in new db
        for ($i = 1; $i <= $lastIdOld; $i++) {
            $wlogs = $oldwlogs->where('id', $i)->first();

            if ($wlogs != null) {
                $this->command->line("{$wlogs->id} \t{$wlogs->boat_namecomplete} is gonna be inserted in new database \n\twith created_at: {$wlogs->created_at} and updated_at: {$wlogs->created_at}");
                if ($wlogs->id == $i) {
                    $this->command->line("<info>{$i} is same ID</info>");

                    if ($wlogs->status == 'charged'){
                        $wlogs->status = 'charged';
                        $invoiced = 1;
                    } elseif ($wlogs->status == 'pending'){
                        $wlogs->status = 'pending';
                        $invoiced = 0;
                    } else {
                        $wlogs->status = 'verifying';
                        $invoiced = 0;
                    }
                    
                    
                    //insert record in new db
                    DB::table('wlogs')->insert([
                        'boat_namecomplete' => $wlogs->boat_namecomplete,
                        'description' => $wlogs->description,
                        'date' => $wlogs->date,
                        'hours' => $wlogs->hours,
                        'status' => $wlogs->status,
                        'notes' => $wlogs->materials,
                        'created_at' => $wlogs->created_at,
                        'updated_at' => $wlogs->created_at,
                        'wlist_id' => $wlogs->wlist_id,
                        'marina_id' => $wlogs->marina_id,
                        'invoiced_line' => $invoiced,
                    ]);

                    
                } else {
                    $this->command->line("<error>{$i} is not same ID</error>");
                }
            } else {
                $this->command->line("<error>{$i} is null</error>");

                DB::table('wlogs')->insert([
                    'boat_namecomplete' => '----',
                    'description' => '----',
                    'date' => '2023-09-01',
                    'hours' => null,
                    'status' => '----',
                    'notes' => '----',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'wlist_id' => null,
                    'marina_id' => null,
                    'invoiced_line' => 0,
                ]);
                $this->command->line("<info>BLANK {$i} is inserted in new database</info>");
            }
        }
    }
}
