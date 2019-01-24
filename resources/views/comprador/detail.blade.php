@extends('layouts.app')
@section('content')
<div class="container-fluid">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif
        <table class="table table-striped">
            <thead>
                <tr>
                <td>#</td>
                <td>Producto</td>
                <td>Descripción</td>
                <td>Categoría</td>
                <td>Precio</td>
                <td>Nuevo</td>
                <td>Vendedor</td>
                <td>¿Vendido?</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$transaccion->id}}</td>
                    <td>{{$transaccion->producto}}</td>
                    <td>{{$transaccion->descripcion}}</td>
                    <td>{{$transaccion->nameCategoria->nombre}}</td>
                    <td>{{$transaccion->precio}}</td>
                    <td>
                    @if($transaccion->nuevo == 0)
                        <p>Segunda mano</p>
                    @else
                        <p>Nuevo</p>
                    @endif
                    </td>
                    <td>
                        {{$transaccion->nameUser->name}}
                    </td>
                    <td>
                    @if($transaccion->vendido == 0)
                        <p>En venta</p>
                    @else
                        <p>Vendido</p>
                    @endif
                    </td>
                    <td>
                    <a class="navbar-brand" href="{{action('AnuncioController@show', $transaccion->id)}}">
                        ¡Comprar!
                    </a>
                    </td>
                </tr>
            </tbody>
        </table>
</div>
@endsection