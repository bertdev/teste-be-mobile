<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'cpf'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
