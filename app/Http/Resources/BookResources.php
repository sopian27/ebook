<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResources extends JsonResource{


    public function toArray($request) {
        //return parent::toArray($request);
        return [
            'gambar' => $this->gambar,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'halaman' => $this->halaman,
            'link' => $this->link,
            'penerbit' => $this->penerbit
        ];
    }

}