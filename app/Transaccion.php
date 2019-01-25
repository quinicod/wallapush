<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $fillable = [
        'id_anuncio', 'id_comprador', 'valoracion'
    ];

    public function ganancia() {
        return $this->belongsTo(Anuncio::class, 'id');
    }

    public function precio() {
        return $this->belongsTo(User::class, 'id');
    }

}
