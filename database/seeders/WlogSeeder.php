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

                    if ($wlogs->assigned == 'root') {
                        $forRole = 1;
                        $forUser = 1;
                    } elseif ($wlogs->assigned == 'admin') {
                        $forRole = 1;
                        $forUser = 5;
                    } elseif ($wlogs->assigned == 'toni') {
                        $forRole = 1;
                        $forUser = 1;
                    } elseif ($wlogs->assigned == 'tech') {
                        $forRole = 3;
                        $forUser = null;
                    } elseif ($wlogs->assigned == 'luiso' || $wlogs->assigned == 'luis') {
                        $forRole = 3;
                        $forUser = 3;
                    } elseif ($wlogs->assigned == 'rodolfo') {
                        $forRole = 3;
                        $forUser = 4;
                    } else{
                        $forRole = 3;
                        $forUser = 1;
                    }

                    if ($wlogs->status == 'estimate'){
                        $wlogs->status = 'pending';
                    } elseif ($wlogs->status == 'pending'){
                        $wlogs->status = 'pending';
                    } elseif ($wlogs->status == 'working'){
                        $wlogs->status = 'progressing';
                    } elseif ($wlogs->status == 'done') {
                        $wlogs->status = 'completed';
                    } else {
                        $wlogs->status = 'verifying';
                    }
                    
                    
                    //insert record in new db
                    DB::table('wlogs')->insert([
                        'order_type' => $wlogs->type,
                        'boat_namecomplete' => $wlogs->boat_namecomplete,
                        'description' => $wlogs->description,
                        'status' => $wlogs->status,
                        'url_invoice' => $wlogs->link_dn,
                        'notes' => $wlogs->assigned,
                        'created_at' => $wlogs->created_at,
                        'updated_at' => $wlogs->created_at,
                        'client_id' => $wlogs->client_id,
                        'deadline' => $wlogs->deadline,
                        'boat_id' => $wlogs->boat_id,
                        'priority_id' => 4,
                    ]);

                    //insert in db role_wlogs
                    DB::table('role_wlogs')->insert([
                        'role_id' => $forRole,
                        'wlogs_id' => $i,
                    ]);

                    //insert in db user_wlogs
                    if ($forUser != null) {
                        DB::table('user_wlogs')->insert([
                            'user_id' => $forUser,
                            'wlogs_id' => $i,
                        ]);
                    }
                } else {
                    $this->command->line("<error>{$i} is not same ID</error>");
                }
            } else {
                $this->command->line("<error>{$i} is null</error>");

                DB::table('wlogs')->insert([
                    'order_type' => 'work',
                    'boat_namecomplete' => '------',
                    'description' => '------',
                    'status' => 'done',
                    'url_invoice' => '',
                    'notes' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                    'client_id' => 1,
                    'boat_id' => 1,
                    'priority_id' => 4,
                ]);
                $this->command->line("<info>BLANK {$i} is inserted in new database</info>");
            }
        }
    }
}
