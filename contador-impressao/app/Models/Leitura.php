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
        'data_leitura',
    ];

    protected $casts = [
        'data_leitura' => 'datetime',
    ];

    public function impressora()
    {
        return $this->belongsTo(Impressora::class);
    }
}

