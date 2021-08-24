<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refferal extends Model
{
    use HasFactory;
    protected $cast = [
        'userList' => 'array'
    ];
    protected $fillable= [
        'userId',
        'refferal',
        'userList'
    ];

    public function user(){
        return $this->hasMany(User::class, 'userId');
    }
}
