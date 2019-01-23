<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'producto', 'id_categoria', 'precio', 'nuevo', 'descripcion', 'id_vendedor', 'vendido'];

    public function nameUser(){
        return $this->belongsTo(User::class, 'id_vendedor');
    }
    
    public function nameCategoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    #  Filtrar productos 
    #   <Query Scope>

        public function scopeProducto($query, $producto)
        {
            if($producto)
                return $query->where('producto', 'LIKE', "%$producto%");
        }

        public function scopeDescripcion($query, $descripcion)
        {
            if($descripcion)
                return $query->where('descripcion', 'LIKE', "%$descripcion%");
        }

        public function scopeCategoria($query, $opcion_categoria)
        {
            $opciones_categorias = config('filtrocategorias.opciones_categorias');

            if($opciones_categorias != "" && isset($opciones_categorias[$opcion_categoria])) 
            {
                $query->where('id_categoria', 'LIKE', $opcion_categoria);
            }
        }
}
