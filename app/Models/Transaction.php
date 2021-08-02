<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'type',
        'gram',
        'adminFee',
        'priceId',
        'nominal',
        'total',
        'status',
        'discount',
        'destinationNumber',
        'message',
        'barcode'
    ];
}

 