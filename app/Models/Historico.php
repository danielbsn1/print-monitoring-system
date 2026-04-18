<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    /** @use HasFactory<\Database\Factories\HistoricoFactory> */
    use HasFactory;
    protected $fillable = [
        'impressora_id',
        'leitura_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function impressora()
    {
        return $this->belongsTo(Impressora::class, 'impressora_id');
    }
    public function leitura()
    {
        return $this->belongsTo(Leitura::class, 'leitura_id');
    }
    public function consultor()
    {
        return $this->belongsToMany(User::class, 'historico_usuario', 'historico_id', 'usuario_id')
            ->withTimestamps();
    }

}
