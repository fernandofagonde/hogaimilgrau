<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayableBill extends Model
{
    use HasFactory;

    protected $fillable = [
        "people_id",
        "status",
        "title",
        "description",
        "amount",
        "payday"
    ];
}
