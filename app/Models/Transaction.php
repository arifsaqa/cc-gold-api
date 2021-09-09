<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'type',
        'gram',
        'payment',
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
    public function user(){
        return $this->BelongsTo(User::class, 'userId', 'id');
    }
    public function userDestinationByNumber(){
        return $this->BelongsTo(User::class, 'destinationNumber','phone');
    }
}

