<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnuncioRequest;
use App\Image;
use \Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        #   Filtrar búsquedas
            $producto  = $request->get('producto');
            $descripcion = $request->get('descripcion');
            $opcion_categoria   = $request->get('id_categoria');

            $anuncios = Anuncio::orderBy('id', 'DESC')
                ->Producto($producto)
                ->Descripcion($descripcion)
                ->Categoria($opcion_categoria)
                ->paginate(4);
            return view('comprador.index', compact('anuncios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=Categoria::all();
        return view('vendedor/nuevoAnuncio', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnuncioRequest $req)
    {
        $user = Auth::user();
        $anuncio = Anuncio::create([
            'producto' => $req->producto,
            'id_categoria' => $req->id_categoria,
            'precio' => $req->precio,
            'nuevo' => $req->nuevo,
            'descripcion' => $req->descripcion,
            'id_vendedor' => $user->id,
        ]);

        foreach($req->img as $i){
            $file = $i;
            $nombre = $file->getClientOriginalName();
            \Storage::disk('anuncios')->put($nombre,  \File::get($file));

            Image::create([
                'id_anuncio' => $anuncio->id,
                'img' => $i,
                ]);
        }
        
        if($anuncio)
            //redirigir al anuncio en concreto una vez este creada esa vista
            return back()->with('message', ['success', __("Anuncio creado correctamente")]);
        else
            return back()->with('message', ['danger', __("Error al crear el anuncio")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
