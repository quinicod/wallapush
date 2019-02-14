<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\User;
use Auth;
use App\Transaccion;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaccion = Transaccion::all();

        return view('transaccion.index',compact('transaccion'));
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
        #   Actualizamos el anuncio
            $anuncio = Anuncio::find($id);
            $anuncio->update(['vendido' => $request->vendido=true]);
            $anuncio->save();
        #   Realizamos la transaccion del saldo del comprador...
            $usuario = Auth::id();
            $comprador = User::find($usuario);
            $anuncio = Anuncio::find($id);
            $precio = $anuncio->precio;
            $saldo = $comprador->saldo-=$precio;
            $comprador->update(['saldo' => $request->saldo=$saldo]);
            $comprador->save();
        # ... al vendedor
            $anuncio = Anuncio::find($id);
            $usuario = $anuncio->id_vendedor;
            $vendedor = User::find($usuario);
            $precio = $anuncio->precio;
            $saldo = $anuncio->nameUser->saldo+=$precio;
            $vendedor->update(['saldo' => $request->saldo=$saldo]);
            $vendedor->save();
        #   Transaccion
            $usuario = Auth::id();
            $transaccion = Transaccion::create([
                'id_anuncio'    => $id,
                'id_comprador'  => $usuario,
            ]);

        return view('transaccion.valoracion', compact('transaccion', 'anuncio'));

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
