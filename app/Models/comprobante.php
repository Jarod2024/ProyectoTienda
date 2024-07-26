<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comprobante extends Model
{
    use HasFactory;
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }
} 
