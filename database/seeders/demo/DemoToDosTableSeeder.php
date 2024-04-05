<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoToDosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toDos = [
            [
                'task' => 'Update navigation software on Yacht X',
                'notes' => 'The client reported issues with the current navigation software version.',
                'deadline' => Carbon::today()->addWeeks(1)->format('Y-m-d'),
                'priority' => 2,
                'is_repetitive' => false,
                'repeat_interval_value' => null,
                'repeat_interval_unit' => null,
                'internal_notes' => 'Check software compatibility with existing hardware.',
                'completed_at' => null,
            ],
            [
                'task' => 'Perform routine maintenance on Boat Z’s radar system',
                'notes' => 'Routine bi-annual radar system checkup and maintenance.',
                'deadline' => Carbon::today()->addWeeks(2)->format('Y-m-d'),
                'priority' => 3,
                'is_repetitive' => true,
                'repeat_interval_value' => 6,
                'repeat_interval_unit' => 'day',
                'internal_notes' => 'Last maintenance was performed 6 months ago.',
                'completed_at' => null,
            ],
            [
                'task' => 'Install new sonar system on Vessel Y',
                'notes' => 'Client requested the latest sonar model for improved fish finding.',
                'deadline' => Carbon::today()->addDays(10)->format('Y-m-d'),
                'priority' => 1,
                'is_repetitive' => false,
                'repeat_interval_value' => 1,
                'repeat_interval_unit' => 'month',
                'internal_notes' => 'Ensure compatibility with client’s current display units.',
                'completed_at' => null,
            ],
            [
                'task' => 'Update firmware for all serviced vessels',
                'notes' => 'Quarterly firmware updates for all navigation and communication systems.',
                'deadline' => Carbon::today()->addMonths(1)->format('Y-m-d'),
                'priority' => 4,
                'is_repetitive' => true,
                'repeat_interval_value' => null,
                'repeat_interval_unit' => null,
                'internal_notes' => 'Prepare update logs and notify clients of any downtime.',
                'completed_at' => null,
            ],
            [
                'task' => 'Conduct training on emergency communication protocols',
                'notes' => 'Annual training for all staff on the latest emergency communication protocols.',
                'deadline' => Carbon::today()->addWeeks(4)->format('Y-m-d'),
                'priority' => 5,
                'is_repetitive' => true,
                'repeat_interval_value' => 2,
                'repeat_interval_unit' => 'year',
                'internal_notes' => 'Update training materials to include recent changes in protocols.',
                'completed_at' => null,
            ],
        ];

        DB::table('to_dos')->insert($toDos);
    }
    }