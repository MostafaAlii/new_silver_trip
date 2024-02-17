<?php

namespace App\Http\Resources\New;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'status' => $this->status ? 'Active' : 'NO Active',
            'name' => $this->name,
            'states' => StateResource::collection($this->states),
        ];
    }
}