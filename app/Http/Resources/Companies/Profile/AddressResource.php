<?php

namespace App\Http\Resources\Companies\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "address" => $this->address,
            "lat" => $this->lat,
            "lng" => $this->lng
        ];
    }
}
