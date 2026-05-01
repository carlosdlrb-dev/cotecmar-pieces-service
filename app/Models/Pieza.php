<?php

namespace App\Models;

use App\Enums\EstadoPieza;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pieza extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bloque_id',
        'codigo',
        'peso_teorico',
        'peso_real',
        'diferencia_peso',
        'estado',
        'fecha_fabricacion',
    ];

    protected $casts = [
        'estado'            => EstadoPieza::class,
        'fecha_fabricacion' => 'datetime',
    ];

    public function bloque(): BelongsTo
    {
        return $this->belongsTo(Bloque::class);
    }
}
