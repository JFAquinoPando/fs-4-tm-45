<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarea extends Model
{
    protected $fillable = [
        "descripcion", "user_id", "realizado", "prioridad"
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'prioridad' => 'boolean',
            'realizado' => 'boolean',
        ];
    }

    public function usuarios(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
