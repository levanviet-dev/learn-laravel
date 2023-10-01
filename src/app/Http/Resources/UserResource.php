<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_code' => $this->user_code,
            'name' => $this->name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'department' => $this->department,
            'postal_code' => $this->postal_code,
            'prefecture' => $this->prefecture,
            'address' => $this->address,
            'building_name' => $this->building_name,
            'phone_number' => $this->phone_number,
        ];
    }
}
