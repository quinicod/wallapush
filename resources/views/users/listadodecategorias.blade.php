@extends('layouts.app')
@section('content')
<style>
    .uper {
      margin-top: 50px;
    }
</style>
<div class="container uper">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-1">
            <h4>Ventas por Categorias</h4>
        </div>
        <div class="col md 4">
            <a href="{{ route('users.index', 'admin') }}" class="btn btn-outline-secondary">Listado</a>
            <a href="{{ route('listado1') }}" class="btn btn-outline-warning">Mejores Vendedores</a>
            <a href="{{ route('listado2') }}" class="btn btn-outline-info">Ventas por Categoria</a>
            <a href="{{ route('listado3') }}" class="btn btn-outline-success">Mejor valorados</a>
        </div>
    </div>
 <br><br>
<div class="row-justify-content">
    <form action="{{ route('filtrolista2') }}" method="POST"> 
        @csrf
        <div class="row-justify-content">
          <div class="col-md-4 offset-md-4">
            <label>Fecha inicio</label>
            <input class="form-control" type="date" placeholder="Fecha inicio" name="fecha_inicio">
            <label>Fecha fin</label>
            <input class="form-control" type="date" placeholder="Fecha fin" name="fecha_fin">
            <div class="row-justify-content">
              <br>
              <div class="col-md-6 offset-md-2">
                <select class="form-control" id="exampleFormControlSelect1" name="id_categoria">
                <option value="">Selecciona categoría</option>  
                @foreach ($categorias as $cat)
                    <option value="{{$cat->id}}">{{$cat->nombre}}</option>  
                @endforeach
                </select>
              </div>
            </div>
            <button class="btn btn-danger" type="submit">Enviar</button>
          </div>
        </div>
    </form>
</div>
<div class="row">
        <div class="container">
                <table class="table table-striped"  id="myTable" data-order='[[0, "desc" ]]'>
                  <thead>
                      <tr>
                        <td align="center"><strong>Producto</strong></td>
                        <td align="center"><strong>Precio</strong></td>
                        <td align="center"><strong>Categoria</strong></td>
                        <td align="center"><strong>Vendedor</strong></td>
                        <td align="center"><strong>Vendido</strong></td>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($anuncios as $a)
                        @if($a->transaccion !=null)  
                        <tr>
                            <td>{{$a->producto}}</td>
                            <td>{{$a->precio}}</td>
                            <td>{{$a->nameCategoria->nombre}}</td>
                            <td>{{$a->nameUser->nombre}}</td>
                            <td>{{$a->vendido}}</td>
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
                </table>
        </div>
</div>
</div>
</div>
<form action="{{ route('pdf') }}" method="POST">
  @csrf
  @if(isset($fecha_inicio) && isset($fecha_fin) && isset($id_categoria))
    <input type="hidden" name="fecha_inicio" value="{{ $fecha_inicio }}">
    <input type="hidden" name="fecha_fin" value="{{ $fecha_fin }}">
    <input type="hidden" name="id_categoria" value="{{ $id_categoria }}">
  @endif
  <div class="col-md-4 offset-md-5">
    <button type="submit" class="btn btn-danger">Generar PDF</button>
  </div>
</form>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      
    });
  });
</script>
@endsection