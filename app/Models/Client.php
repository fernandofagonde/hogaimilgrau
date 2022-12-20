<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;/*

    *
    * Define fillable fields
    */
    protected $fillable = [
        "status",
        "name",
        "document",
        "phone",
        "phone_whatsapp",
        "city",
        "uf",
        "email",
        "password",
        "remember_token"
    ];
}
