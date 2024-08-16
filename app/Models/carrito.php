<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
   

    // Fillable attributes
    protected $fillable = [
        'cliente_id',
        'fecha_creacion',
    ];

    

    // Relationship with Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relationship with Producto (adjust as needed)
    public function Comprobante()
    {
        return $this->hasOne(comprobante::class, 'id', 'productos'); // Adjust if needed based on how products are related
    }
    
    public function detallesCarrito()
    {
    return $this->hasMany(DetallesCarrito::class);
    }
    
}
