<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WlistStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'In Progress'],
            ['name' => 'Completed'],
            ['name' => 'On Hold'],
            ['name' => 'Cancelled'],
            ['name' => 'Awaiting Approval'],
        ];

        DB::table('wlist_statuses')->insert($statuses);
    }
}