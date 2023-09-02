<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lastIdOld = DB::connection('mysql_old')->table('wlist')->orderBy('id', 'desc')->first()->id;
        // get last id in wlist table at db mysql_old
        $this->command->line("{$lastIdOld} is the last ID in old database");
        // get all records from wlist table at db mysql_old
        $oldWlists = DB::connection('mysql_old')->table('wlist')->get();
        $this->command->line("{$oldWlists->count()} records found in old database");
        //count registered wlists in new db
        $count = DB::table('wlists')->count();
        $this->command->line("{$count} records found in new database");
        if ($count > 0) {
            //get last id in new db
            $lastId = DB::table('wlists')->orderBy('id', 'desc')->first()->id;
            $nextId = $lastId + 1;
            $this->command->line("There are already records in new database, next ID is {$nextId}");
            return;
        } else {
            $this->command->line("There are no records in new database, let's start from 1");
            $nextId = 1;
        }


        // insert records in new db
        for ($i = 1; $i <= $lastIdOld; $i++) {
            $wlist = $oldWlists->where('id', $i)->first();

            if ($wlist != null) {
                $this->command->line("{$wlist->id} \t{$wlist->boat_namecomplete} is gonna be inserted in new database \n\twith created_at: {$wlist->created_at} and updated_at: {$wlist->created_at}");
                if ($wlist->id == $i) {
                    $this->command->line("<info>{$i} is same ID</info>");
                    //insert record in new db
                    DB::table('wlists')->insert([
                        'order_type' => $wlist->type,
                        'boat_namecomplete' => $wlist->boat_namecomplete,
                        'description' => $wlist->description,
                        'status' => $wlist->status,
                        'url_invoice' => $wlist->link_dn,
                        'notes' => $wlist->assigned,
                        'created_at' => $wlist->created_at,
                        'updated_at' => $wlist->created_at,
                        'client_id' => $wlist->client_id,
                        'deadline' => $wlist->deadline,
                        'boat_id' => $wlist->boat_id,
                        'priority_id' => 4,
                    ]);
                } else {
                    $this->command->line("<error>{$i} is not same ID</error>");
                }
            } else {
                $this->command->line("<error>{$i} is null</error>");

                DB::table('wlists')->insert([
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
