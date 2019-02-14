<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use App\Anuncio;
use App\Categoria;

class ListadosController extends Controller
{
    public function index(){
        $transacciones=Transaccion::all();

        return view('users/index', compact('transacciones'));
    }

    // public function listado2(Request $req){
    //     $anuncios=Anuncio::where('created_at','>=',$req->fecha_ini)->where('created_at','<=',$req->fin)->where('id_categoria', $req->id_categoria)->with('concepto')->get();
    //     foreach ($anuncios->concepto as $t){
            
    //     }
    // }
}
