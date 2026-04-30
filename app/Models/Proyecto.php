<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function bloques(): HasMany
    {
        return $this->hasMany(Bloque::class);
    }

    public function piezas(): HasManyThrough
    {
        return $this->hasManyThrough(Pieza::class, Bloque::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Proyecto $proyecto) {
            if ($proyecto->isForceDeleting()) {
                $proyecto->bloques()->withTrashed()->get()->each->forceDelete();

                return;
            }

            $proyecto->bloques()->get()->each->delete();
        });
    }
}
