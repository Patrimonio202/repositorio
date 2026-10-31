<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Suscriptor - v1.0 (30/10/2026): persona suscrita al boletin del pie de pagina
class Suscriptor extends Model
{
    protected $table = 'suscriptores';

    protected $fillable = ['email', 'token', 'aceptado_en', 'confirmado_en', 'baja_en'];

    protected $casts = [
        'aceptado_en' => 'datetime',
        'confirmado_en' => 'datetime',
        'baja_en' => 'datetime',
    ];

    // suscripcion activa: confirmo su correo y no se ha dado de baja
    public function getActivoAttribute(): bool
    {
        return $this->confirmado_en !== null && $this->baja_en === null;
    }
}
