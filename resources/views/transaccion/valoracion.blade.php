@extends('layouts.app')

@section('content')
    
    <div class="uper card-body">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
        @endif
    </div>

    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif

    <div class="row justify-content-md-center">
        <h1>¡Danos tu opinión por favor!</h1>
        <h2>Contribuye al crecimiento del vendedor para que su oferta mejore con el tiempo.</h2>
    </div>
    <div class="card-body justify-content-md-center" align="center">
        <h3>Producto: {{ __(":producto", ['producto' => $anuncio->producto]) }}<h3>
        <h3>Vendedor: {{ __(":id_vendedor", ['id_vendedor' => $anuncio->nameUser->name]) }}</h3>
    <div>
    <div class="row col-md-4 justify-content-md-center" align="center">
        <form action="{{route('opinion', $transaccion->id)}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_method"/>
            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
                Dar mi opinión
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                      
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Califique a {{ __(":id_vendedor", ['id_vendedor' => $anuncio->nameUser->name]) }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body">
                            <h2> Otorga una puntuación del 1 al 5 </h2>
                            <h6> Siendo 1 MUY INSATISFECHO y 5 MUY SATISFECHO</h6>
                                <input type="radio" name="valoracion" id="valoracion" class="" value="1" {{ $transaccion->valoracion == 1 }}>  1<br>
                                    
                                <input type="radio" name="valoracion" id="valoracion" class="" value="2" {{ $transaccion->valoracion == 2 }}>  2<br>
                                
                                <input type="radio" name="valoracion" id="valoracion" class="" value="3" {{ $transaccion->valoracion == 3 }}>  3<br>

                                <input type="radio" name="valoracion" id="valoracion" class="" value="4" {{ $transaccion->valoracion == 4 }}>  4<br>
                                    
                                <input type="radio" name="valoracion" id="valoracion" class="" value="5" {{ $transaccion->valoracion == 5 }}>  5
                        </div>
                        <div class="modal-footer">
                            <form action="{{route('opinion', $transaccion->id)}}" method="POST">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="POST">
        
                                <button class="btn btn-success btn-block" type="submit">Dar opinión</button>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                    </div>
                </div>
        </form>
        <a href="{{ route('comprador.index') }}" class="btn btn-info btn-danger" >No, gracias</a>
    <div>
@endsection