<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Employee',
            'date_field' => 'contract_ends',
            'field'      => 'id_employee',
            'prefix'     => 'Employee ENDs',
            'suffix'     => '',
            'route'      => 'admin.employees.edit',
        ],
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'when_starts',
            'field'      => 'id',
            'prefix'     => 'Appointment',
            'suffix'     => '',
            'route'      => 'admin.appointments.edit',
        ],
        [
            'model'      => '\App\Models\Wlist',
            'date_field' => 'deadline',
            'field'      => 'id',
            'prefix'     => 'WorkDeadline',
            'suffix'     => '',
            'route'      => 'admin.wlists.edit',
        ],
        [
            'model'      => '\App\Models\ToDo',
            'date_field' => 'deadline',
            'field'      => 'task',
            'prefix'     => 'Task:',
            'suffix'     => '',
            'route'      => 'admin.to-dos.edit',
        ],
        [
            'model'      => '\App\Models\AssetsRental',
            'date_field' => 'start_date',
            'field'      => 'end_date',
            'prefix'     => '',
            'suffix'     => 'rental ends',
            'route'      => 'admin.assets-rentals.edit',
        ],
        [
            'model'      => '\App\Models\BookingList',
            'date_field' => 'date',
            'field'      => 'id',
            'prefix'     => 'Booking ID',
            'suffix'     => 'starts today',
            'route'      => 'admin.booking-lists.edit',
        ],
        [
            'model'      => '\App\Models\ClientsReview',
            'date_field' => 'created_at',
            'field'      => 'rating',
            'prefix'     => 'Review',
            'suffix'     => '',
            'route'      => 'admin.clients-reviews.edit',
        ],
        [
            'model'      => '\App\Models\Suscription',
            'date_field' => 'start_date',
            'field'      => 'id',
            'prefix'     => 'VIP suscription',
            'suffix'     => 'starts today',
            'route'      => 'admin.suscriptions.edit',
        ],
        [
            'model'      => '\App\Models\Suscription',
            'date_field' => 'end_date',
            'field'      => 'id',
            'prefix'     => 'VIP suscription',
            'suffix'     => 'ENDS today',
            'route'      => 'admin.suscriptions.edit',
        ],
        [
            'model'      => '\App\Models\Documentation',
            'date_field' => 'expiration_date',
            'field'      => 'name',
            'prefix'     => 'Document',
            'suffix'     => 'expires today',
            'route'      => 'admin.documentations.edit',
        ],
        [
            'model'      => '\App\Models\Insurance',
            'date_field' => 'end_date',
            'field'      => 'provider_name',
            'prefix'     => 'Insurance',
            'suffix'     => 'ENDS today',
            'route'      => 'admin.insurances.edit',
        ],
        [
            'model'      => '\App\Models\MaintenanceSuscription',
            'date_field' => 'start_date',
            'field'      => 'id',
            'prefix'     => 'Maintenance suscription',
            'suffix'     => 'STARTS today',
            'route'      => 'admin.maintenance-suscriptions.edit',
        ],
        [
            'model'      => '\App\Models\MaintenanceSuscription',
            'date_field' => 'end_date',
            'field'      => 'id',
            'prefix'     => 'Maintenance suscription',
            'suffix'     => 'ENDS today',
            'route'      => 'admin.maintenance-suscriptions.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
