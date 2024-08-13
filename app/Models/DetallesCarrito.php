<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesCarrito extends Model
{
    use HasFactory;
    

    protected $fillable = ['carrito_id', 'producto_id', 'cantidad', 'precio', 'subtotal'];

    public function carrito()
{
    return $this->belongsTo(Carrito::class);
}

public function producto()
{
    return $this->belongsTo(Productos::class);
}
// Mutador para calcular el subtotal
public function setCantidadAttribute($value)
{
    $this->attributes['cantidad'] = $value;

    if ($this->precio) {
        $this->attributes['subtotal'] = $value * $this->precio;
    }
}

// Mutador para calcular el subtotal cuando el precio cambia
public function setPrecioAttribute($value)
{
    $this->attributes['precio'] = $value;

    if ($this->cantidad) {
        $this->attributes['subtotal'] = $this->cantidad * $value;
    }
}
}
