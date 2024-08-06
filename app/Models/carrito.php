<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    // Fillable attributes
    protected $fillable = ['cliente_id', 'productos', 'total'];

    // Casts for attributes
    protected $casts = [
        'productos' => 'array',
        'total' => 'decimal:2',
    ];

    // Relationship with Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relationship with Producto (adjust as needed)
    public function producto()
    {
        return $this->hasMany(Productos::class, 'id', 'productos'); // Adjust if needed based on how products are related
    }

    // Relationship with Comprobante
    public function comprobante()
    {
        return $this->hasOne(Comprobante::class, 'carrito_id');
    }
}
