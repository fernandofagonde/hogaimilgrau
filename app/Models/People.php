<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    /*
    * Define fillable fields
    */
    protected $fillable = [
        "client_id",
        "type",
        "name",
        "document_type",
        "document",
        "email",
        "phone",
        "phone_whatsapp"
    ];
}
