<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
