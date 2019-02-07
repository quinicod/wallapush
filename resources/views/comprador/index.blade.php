@extends('layouts.app')

@section('content')
<style>
    .uper {
      margin-top: 50px;
    }
  </style>

<!-- Mensaje de alerta -->

<div class="uper card-body">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
</div>

<!-- Inicio - Filtro de búsqueda -->

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
            {{ Form::select('id_categoria', config('filtrocategorias.opciones_categorias'), null, ['class' =>
            'form-control', 'placeholder' => 'Seleccione una categoría']) }}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </div>
        {{ Form::close() }}
    </h1>
</div>

<!-- Fin - Filtro de búsqueda -->
@forelse($producto as $index)
<table id="filtro" class="display">
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
        <div class="card-body">
          <h5><strong>{{ substr($a['producto'],0,20) }}... {{ $a['precio'] }}€</strong></h5>
            <div id="el_div{{ $a['id']}}">
              <p class="card-text">{{substr($a['descripcion'],0,150)}}...</p>
            </div> <br>
            @if($a['vendido'] == false)
              <a href="" data-toggle="modal" data-target="#editModal{{ $a['id'] }}">Editar</a> 
            @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<br>
</table>
@empty
  <div class="text-center">
      <br><br>
      <h4>No hay anuncios publicados.</h4>
      <a href="{{ route('vendedor.create') }}">¡Publica uno Aquí!</a>
  </div>
@endforelse

<!-- Paginación -->

@if($anuncios->count())
{!! $anuncios->appends(Request::only(['producto', 'descripcion' , 'id_categoria']))->render() !!}
@endif

<!-- Fin - Paginación -->

<script type="text/javascript">
  $(document).ready(function() {
      $('#filtro').DataTable();
  } );
</script>
@endsection
