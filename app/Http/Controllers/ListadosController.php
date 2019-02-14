<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\Categoria;

class ListadosController extends Controller
{
    public function index(Request $req){
        $anuncios=Anuncio::where('created_at','>=',$req->fecha_ini)->where('created_at','<=',$req->fin)->where('id_categoria', $req->id_categoria)->with('concepto')->get();
    }
}
