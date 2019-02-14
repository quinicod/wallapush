<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use app\Transaccion;
use app\Categoria;
use app\Anuncio;

class Transaccion extends Model
{
    protected $fillable = [
        'id_anuncio', 'id_comprador', 'valoracion'
    ];

    public function concepto() {
        return $this->belongsTo(Anuncio::class, 'id_anuncio');
    }

    public function comprador() {
        return $this->belongsTo(User::class, 'id_comprador');
    }

    // public function anuncio(){
    //     return $this->belongsTo(Anuncio::class, 'id_anuncio');
    // }

}
