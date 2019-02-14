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

}
