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
        'cod_transferencia',
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con Carrito
    public function Carrito()
    {
        return $this->belongsTo(carrito::class);
    }

 
    public function calcularTotal()
    {
        return $this->carritos()->sum('total');
    }
} 
