@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif
    <div class="card-body" align="center">
        <div class="row justify-content-md-center">
            <h1>{{ __("Anuncio :producto", ['producto' => $anuncio->producto]) }}</h1>
        </div>
        <div class="col-md-3" align="center">
            <h4>{{ __("Vendido por :id_vendedor", ['id_vendedor' => $anuncio->nameUser->name]) }}</h4>
        </div>
        <!-- Imagen -->
        @foreach($anuncios as $index)
            <div class="row justify-content-md-center">
            @foreach($index as $a)
                <div class="col-md-3">
                    <div class="card">
                    @if($a['imagenes'] == '[]')
                        <img class="card-img-top" src="" alt="Card image cap">
                    @endif
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($a['imagenes'] as $index => $i)
                                @if($index == 0)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                @else
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"></li>
                                @endif
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                        @foreach($a['imagenes'] as $index => $i)
                            @if($index == 0)
                                <div class="carousel-item active">
                                    <img src="{{asset('../storage/app/anuncios/'.$i['img'])}}" class="d-block w-100">
                                </div>
                            @else
                                <div class="carousel-item">
                                    <img src="{{asset('../storage/app/anuncios/'.$i['img'])}}" class="d-block w-100">
                                </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endforeach
    </div>
    <!-- Descripción -->
    <div class="row justify-content-md-center">
        <h3>Descripción del producto</h3>
    </div>
    <div class="card col-md-3" align="center">
        <p>{{ __(":descripcion", ['descripcion' => $anuncio->descripcion]) }}</p>
    </div>
    <div class="row col-md-1 justify-content-md-center">
        <input type="submit"  value="Comprar" class="btn btn-success btn-block">
        <a href="{{ route('comprador.index') }}" class="btn btn-info btn-block" >Atrás</a>
    </div>
@endsection
