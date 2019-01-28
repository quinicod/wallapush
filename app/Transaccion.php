<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $fillable = [
        'id_anuncio', 'id_comprador', 'valoracion'
    ];

    public function concepto() {
        return $this->belongsTo(Anuncio::class, 'id');
    }

    public function comprador() {
        return $this->belongsTo(User::class, 'id');
    }

}
