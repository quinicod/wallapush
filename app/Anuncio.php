<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'producto', 'id_categoria', 'precio', 'nuevo', 'img', 'descripcion', 'id_vendedor', 'vendido'];
}
