<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
         'logo'
    ];

    public function bankaccount()
    {
        return $this->hasMany(BankAccount::class);
    }
}
