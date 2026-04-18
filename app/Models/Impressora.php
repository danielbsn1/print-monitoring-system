<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impressora extends Model
{
    /** @use HasFactory<\Database\Factories\ImpressoraFactory> */

    use HasFactory;

    protected $fillable = [
        'nome',
        'modelo',
        'serie',
        'ip',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsToMany(User::class, 'impressora_usuario', 'impressora_id', 'usuario_id')
            ->withTimestamps();
    }

    public function leituras()
    {
        return $this->hasMany(\App\Models\Leitura::class);
    }
}
