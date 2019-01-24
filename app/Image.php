<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id_anuncio', 'img'];

    public function anuncios() {
        return $this->hasMany(Anuncio::class, 'id');
    }
}
