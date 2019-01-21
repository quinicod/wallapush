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

        public function scopeIDCategoria($query, $id_categoria)
        {
            if($id_categoria)
                return $query->where('id_categoria', 'LIKE', "%$id_categoria%");
        }

        public function scopeIDVendedor($query, $id_vendedor)
        {
            if($id_vendedor)
                return $query->where('id_vendedor', 'LIKE', "%$id_vendedor%");
        }
}
