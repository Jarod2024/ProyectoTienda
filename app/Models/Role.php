<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        // Otros campos según tu aplicación
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
