<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrito extends Model
{
    use HasFactory;
    // Relación con el usuario
    
    protected $fillable = ['cliente_id', 'producto_id', 'subtotal'];
    
    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'usuario_id');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    } 

    // Relación con el comprobante
    public function comprobante()
    {
        return $this->hasOne(Comprobante::class, 'carrito_id');
    }
}
