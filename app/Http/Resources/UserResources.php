<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource{


    public function toArray($request) {
        return [
            'username' => $this->username,
            'status' => $this->status,
        ];
    }

}