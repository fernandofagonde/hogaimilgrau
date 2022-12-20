<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsLogin extends Model
{
    use HasFactory;

    /**
     * Define fillable fields
     */
    protected $fillable = [
        "client_id",
        "token"
    ];
}
