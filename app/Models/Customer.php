<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'cpf'
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function phone()
    {
        return $this->hasOne(Phone::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
