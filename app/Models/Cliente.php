<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'email', 'Direccion', 'phone_number', 'year_of_birth',
    ];

    public function carrito()
    {
        return $this->hasOne(carrito::class);
    }
    public function cliente()
    {
        return $this->hasOne(cliente::class);
    }
}
