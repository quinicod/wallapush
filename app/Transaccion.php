<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $fillable = [
        'id_anuncio', 'id_comprador', 'valoracion'
    ];

    
}
