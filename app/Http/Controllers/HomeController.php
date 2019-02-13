<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\Categoria;

class HomeController extends Controller
{
    public function inicio(){
        return redirect()->route('home');
    }
    public function index()
    {
        #   Mostrar anuncios con su imagen
            $anuncios = Anuncio::orderBy('created_at', 'ASC')->with('imagenes')->paginate(20);

            return view('comprador/index', compact('anuncios'));
    }

    public function filtros(Request $request)
    {
        #   Filtrar búsquedas
        // $anuncios = Anuncio::where('producto','LIKE', "%$producto%")->orWhere('descripcion','LIKE', "%$producto%")->orderBy('id', 'DESC')->paginate(8);
            $producto  = $request->get('producto');
            $opcion_categoria   = $request->get('id_categoria');

            $anuncios = Anuncio::orderBy('id', 'DESC')
                ->Producto($producto)
                ->Descripcion($producto)
                ->Categoria($opcion_categoria)
                ->paginate(8);

            return view('comprador/index', compact('anuncios'));
    }
}
