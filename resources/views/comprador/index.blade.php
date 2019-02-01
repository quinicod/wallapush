@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 50px;
  }
</style>
  <div class="uper card-body">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
  </div>
  <div class="row justify-content-md-center">
    <h1>
        Buscar Productos
        {{ Form::open(['route' => 'comprador.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
            <div class="form-group">
                {{ Form::text('producto', null, ['class' => 'form-control', 'placeholder' => 'Producto']) }}
            </div>
            <div class="form-group">
                {{ Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripción']) }}
            </div>
            <div class="form-group">
                {{ Form::select('id_categoria', config('filtrocategorias.opciones_categorias'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una categoría']) }}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark" name="listado compras">
                <a href= "{{route('misCompras')}}">Lista Compras</a>
                </button>
            </div>
        {{ Form::close() }}
    </h1>
  </div>
  <div class="justify-content-md-center" align="center">
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
            <td>Enlace del anuncio</td>
          </tr>
      </thead>
      <tbody>
          @foreach($anuncios as $anuncio)
          <tr>
              <td>{{$anuncio->id}}</td>
              <td>{{$anuncio->producto}}</td>
              <td>{{$anuncio->descripcion}}</td>
              <td>{{$anuncio->nameCategoria->nombre}}</td>
              <td>{{$anuncio->precio}}</td>
              <td>
                @if($anuncio->nuevo == 0)
                  <p>Segunda mano</p>
                @else
                  <p>Nuevo</p>
                @endif
              </td>
              <td>
                  {{$anuncio->nameUser->name}}
              </td>
              <td>
                @if($anuncio->vendido == 0)
                  <p>En venta</p>
                @else
                  <p>Vendido</p>
                @endif
              </td>
              <td>
                  @if($anuncio->vendido == 0)
                      <a class="navbar-brand" href="{{action('AnuncioController@show', $anuncio->id)}}">
                          ¡Lo quiero!
                      </a>
                  @else
                      <p>¡Lo sentimos, no está a la venta!</p>
                  @endif
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  @if($anuncios->count())
    {!! $anuncios->appends(Request::only(['producto', 'descripcion' , 'id_categoria']))->render() !!}
  @endif
@endsection