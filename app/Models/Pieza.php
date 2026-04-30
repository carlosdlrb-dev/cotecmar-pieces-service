<?php

namespace App\Models;

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
    ];

    public function bloque(): BelongsTo
    {
        return $this->belongsTo(Bloque::class);
    }
}
