<?php

namespace App\Observers;

use App\Models\Wlog;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class WlogActionObserver
{
    public function created(Wlog $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Wlog'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
