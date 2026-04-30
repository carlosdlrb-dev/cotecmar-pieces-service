<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bloque extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'proyecto_id',
        'nombre',
        'codigo',
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function piezas(): HasMany
    {
        return $this->hasMany(Pieza::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Bloque $bloque) {
            if ($bloque->isForceDeleting()) {
                $bloque->piezas()->withTrashed()->get()->each->forceDelete();

                return;
            }

            $bloque->piezas()->get()->each->delete();
        });
    }
}
