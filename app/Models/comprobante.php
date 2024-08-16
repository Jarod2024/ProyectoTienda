<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comprobante extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'carrito_id',
        'fecha',
        'monto_total',
        'estado',
    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con los carritos
    
    public function calcularTotal()
    {
        return $this->carritos()->sum('total');
    }
} 
