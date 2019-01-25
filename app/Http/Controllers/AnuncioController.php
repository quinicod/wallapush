<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnuncioRequest;
use App\Image;
use \Illuminate\Support\Facades\Storage;
use App\User;
use App\Transaccion;

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
            return view('comprador/index', compact('anuncios'));
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
                'img' => $nombre,
                ]);
        }
        
        if($anuncio)
            //redirigir al anuncio en concreto una vez este creada esa vista *
            return redirect()->route('misAnuncios')->with('message', ['success', __("Anuncio creado correctamente")]);
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
        #   Mostrar anuncio con sus atributos (producto, vendedor, imagen, descripción...)
            $anuncio=Anuncio::find($id);
            
            $anuncios = Anuncio::orderBy('created_at', 'asc')->select('id')->where('id', $id)->with('imagenes')->get()->toArray();
            $anuncios=Array_chunk($anuncios,3,true); 
        
        #   Simulación de la transacción    
            $usuario = Auth::id();
            $comprador = User::find($usuario);
            $precio = $anuncio->precio;
            
            return view('transaccion.index', compact('anuncio', 'anuncios', 'comprador', 'precio'));
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
        $anuncio = Anuncio::find($id);
        //actualizando anuncio
        $anuncio->update([
            'producto' => $request->producto,
            'id_categoria' => $request->id_categoria,
            'precio' => $request->precio,
            'nuevo' => $request->nuevo,
            'descripcion' => $request->descripcion,
        ]);
        $anuncio->save();

        //borrando posibles imagenes
        if($request->imgBorrado != null){
            $imgBorrado = explode(',',$request->imgBorrado); 
            foreach($imgBorrado as $i){
                $valor = intval($i);
                $imagen = Image::find($valor);
                Storage::disk('anuncios')->delete($imagen->img);
                $imagen->delete();
            }
        }

        //añadiendo posibles imagenes
        if(isset($request->img)){
            foreach($request->img as $img){
                $file = $img;
                $nombre = $file->getClientOriginalName();
                Storage::disk('anuncios')->put($nombre,  \File::get($file));

                Image::create([
                    'id_anuncio' => $anuncio->id,
                    'img' => $nombre,
                ]);
            }
        }

        return back()->with('message', ['success', __("Anuncio actualizado correctamente")]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->delete();
        //Borrado con funcion boot en el modelo. En el que se borran las imagenes que tiene el anuncio.
        if($anuncio)
            return back()->with('message', ['success', __("Anuncio borrado correctamente")]);
        else
            return back()->with('message', ['danger', __("Error al borrar el anuncio")]);
    }

    public function misAnuncios()
    {
        $usuario = Auth::id();
        $anuncios = Anuncio::orderBy('created_at', 'asc')->where('id_vendedor',$usuario)->with('imagenes')->get()->toArray();
        $anuncios=Array_chunk($anuncios,3,true);
        $categorias=Categoria::all();
        $imgBorrado = array();
        $imgB=null;
        //dd($imgBorrado);
        return view('vendedor/misAnuncios', compact('anuncios','categorias','imgBorrado','imgB'));
    }
}
