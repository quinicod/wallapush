@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif
        @forelse($compras as $compra)
            <div class="row justify-content-md-center">
            {{-- @foreach($compra as $c)
                <div class="col-md-3">
                    <div class="card"> --}}
                    {{-- @if($c['imagenes'] == '[]')
                        <img class="card-img-top" src="" alt="Card image cap">
                    @else
                    <a href="">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($c['imagenes'] as $index => $i)
                                    @if($index == 0)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    @else
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"></li>
                                    @endif
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                            @foreach($c['imagenes'] as $index => $i)
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
                    </a>
                    @endif --}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5><strong>{{ $compra['id_anuncio'] }}... {{ $compra['valoracion'] }}</strong></h5>
                            <div class="float-md-right">
                                <p class="vendido">Comprado</p>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
        </div>
        <br>
        @empty
            <div class="text-center">
                <br><br>
                <h4>No tienes productos comprados.</h4>
                <a href="{{ route('comprador.index') }}">Compra uno Aqui!</a>
            </div>
        @endforelse

<script type="text/javascript">
    var imgBorrado = new Array();
    function borrar(i){
        var img = document.getElementById(i);
        if(img.style.opacity == 0.5){
            img.style.opacity = 1;
            var deleted = imgBorrado.indexOf(i);
            imgBorrado.splice( deleted, 1 );
        }else{
            img.style.opacity = 0.5;
            imgBorrado.push(i);
        }
    }
    function arrayImg(id){
        var imgB = imgBorrado.toString();
        document.getElementById("imgB"+id).value = imgB;
        
    }
</script>
@endsection
