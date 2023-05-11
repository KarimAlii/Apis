<?php

namespace App\Http\Resources\Companies\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            "industry" => $this->industry,
            "size" => $this->size
        ];
    }
}
