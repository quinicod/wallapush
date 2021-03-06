@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif
    <div class="card row-justify-content" align="center">
        <div class="card-header">
                <h1>{{ __(":producto", ['producto' => $anuncio->producto]) }}</h1>
            <div class="col-md-3">
                <h4>{{ __("Vendido por :id_vendedor", ['id_vendedor' => $anuncio->nameUser->name]) }}</h4>
            </div>
        </div><br>
        <!-- Imagen -->
        <div class="">
            <div class="col-md-3">
                @if($anuncio->imagenes == '[]')
                    <div class="alert alert-danger"> Este anuncio no tiene imágenes. </div>
                @endif
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    @foreach($anuncio->imagenes as $index => $i)
                        @if($index == 0)
                            <div class="carousel-item active">
                                <img src="{{asset('../storage/app/anuncios/'.$i->img)}}" class="d-block w-100">
                            </div>
                        @else
                            <div class="carousel-item">
                                <img src="{{asset('../storage/app/anuncios/'.$i->img)}}" class="d-block w-100">
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div><br>
        <!-- Descripción y precio -->
        <div class="">
            <h3>Precio: {{ __(":precio", ['precio' => $anuncio->precio]) }}€</h3>
        </div>
        <div class="">
            <h4>Descripción del producto</h4>
        </div>
        <div class="col-md-4 offset-md-4" align="center">
            <p>{{ __(":descripcion", ['descripcion' => $anuncio->descripcion]) }}</p>
        </div><br>
        <!-- Opciones -->
        <div class="col-md-4 offset-md-4">
            @if($usuario == $vendedor)
                <a href="{{ route('home') }}" class="btn btn-info btn-danger" >Eres el propietario de este anuncio</a><br>
            @elseif(Auth::user()->saldo >= $anuncio->precio && !($usuario == $vendedor))
            <form action="{{route('transaccion.update', $anuncio->id)}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method"/>
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
                    Comprar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Advertencia</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                            <div class="modal-body">
                                <p>
                                    Va a realizar la compra del producto {{ __(":producto", ['producto' => $anuncio->producto]) }}<br>
                                    Su saldo actual es de {{ __(":saldo", ['saldo' => $comprador->saldo]) }}€ 
                                    y pasará a ser {{ __(":saldo", ['saldo' => $comprador->saldo-=$precio]) }}€ tras la compra.<br><br><br>
                                    Por favor, confirme la operación para efectuar el pago.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('transaccion.update', $anuncio->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="PATCH">
            
                                    <button class="btn btn-success btn-block" type="submit">Confirmar compra</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                            </div>
                        </div>
                    </div>
            </form>
            @elseif(Auth::user()->saldo < $anuncio->precio)
                <button class="btn btn-info btn-danger">No tiene suficiente saldo - Saldo: {{ __(":saldo", ['saldo' => $comprador->saldo]) }}€ < Precio {{ __(":precio", ['precio' => $anuncio->precio]) }}€</button>
            @endif
        </div><br> <br>
        <div class=" col-md-4 offset-md-4">
            <a href="{{ route('home') }}" class="btn btn-info" >Ir al listado de anuncios</a>
        </div><br>
    </div>
</div>
@endsection