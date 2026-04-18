<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    /** @use HasFactory<\Database\Factories\LeituraFactory> */
    use HasFactory;

    protected $fillable = [
        'impressora_id',
        'contador',
        'contador_anterior',
        'data_leitura',
    ];

    protected $casts = [
        'contador' => 'integer',
        'contador_anterior' => 'integer',
        'data_leitura' => 'datetime',
    ];

    public function impressora()
    {
        return $this->belongsTo(Impressora::class);
    }
}

