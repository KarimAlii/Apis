<?php

namespace App\Http\Resources\Companies\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(
        Request $request
    ): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "company" => CompanyResource::make($this->company),
            "address" => AddressResource::make($this->company->address),
            "image" => $this->company->image
        ];
    }
}
