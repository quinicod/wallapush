@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif
        @forelse($compras as $compra)
            <div class="row justify-content-md-center">
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
        <br>
        @empty
            <div class="text-center">
                <br><br>
                <h4>No tienes productos comprados.</h4>
                <a href="{{ route('comprador.index') }}">Compra uno Aqui!</a>
            </div>
        @endforelse
@endsection
