<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'author',
        'year',
        'quantity',
        'ref_code',
        'price'
    ];

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean'
    ];
}
