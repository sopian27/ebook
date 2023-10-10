<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRead extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','token','book_id','email','create_date','update_date'
    ];

}