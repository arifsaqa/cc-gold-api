<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'numberAccount',
        'paymentMethodId'
    ];
    public function paymentmethod(){
        return $this->belongsTo(PaymentMethod::class, 'paymentMethodId');
    }
}
