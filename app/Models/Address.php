<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'street',
        'number',
        'district',
        'complement',
        'city',
        'state',
        'customer_id'
    ];

    protected $hidden = [
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
