<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkInDate',
        'checkOutDate',
        'paid',
        'rated',
        'roomId',
        'hotelId',
        'customerId'
    ];
}
