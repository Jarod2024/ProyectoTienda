<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    public function estrenos()
    {
        return $this->hasMany(Estrenos::class,'producto_id');
    }
    public function ofertas()
    {
        return $this->hasOne(Ofertas::class, 'producto_id');
    }
    public function plataforma()
    {
        return $this->belongsTo(Plataforma::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
}
