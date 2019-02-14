<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transaccion;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #   Mostrar usuarios por orden alfabético
        $users = User::all();
        $orden=0;

        return view('users.index', compact('users','orden'));
    }

    public function listado1()
    {
        $users = User::with('tieneAnuncio')->get();
        $orden=2;

        return view('users.mejoresVendedores', compact('users','orden'));
    }

    public function listado3()
    {
        $users = User::with('anuncios.transaccion')->get();
        //dd($users);
        $orden=0;
        return view('users.valoracionesVendedores', compact('users','orden'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        $this->validate($request,['saldo'=>'required|integer|Min:0', 'actived' => 'required']);

        $user = User::find($id)->update($request->all());

        return redirect('/users?admin')->with('success', '¡Usuario actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users?admin')->with('success', 'Usuario eliminado con éxito.');
    }
    public function listadoxcat(Request $req){
        $anuncios=anuncio::all();
        $categorias=categoria::name();
        $ventas=Transaccion::anuncio()->where('create_at'>=$req->fini)->where('create_at'<=$req->ffin)->where('id_categoria', $req->categoria)->get();
        $dd($ventas);
    }
}
