<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResourcesDetail extends JsonResource{


    public function toArray($request) {
        return [
            'link' => $this->link
        ];
    }

}