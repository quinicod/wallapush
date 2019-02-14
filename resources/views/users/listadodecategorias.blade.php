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
            <h4>Mejores vendedores</h4>
        </div>
        <div class="col md 4">
            <a href="{{ route('users.index', 'admin') }}" class="btn btn-outline-secondary">Listado</a>
            <a href="{{ route('listado1') }}" class="btn btn-outline-warning">Mejores Vendedores</a>
            <a href="{{ route('listado2') }}" class="btn btn-outline-info">Ventas por Categoria</a>
            <a href="{{ route('listado3') }}" class="btn btn-outline-success">Mejor valorados</a>
        </div>
    </div>
</div> <br><br>
<div class="form-group">
    <form action="{{ route('filtrolista2') }}" method="POST"> 
        @csrf
        <div class="row">
            <label>Fecha inicio</label>
            <input type="date" placeholder="Fecha inicio" name="fecha_inicio">
            <label>Fecha fin</label>
            <input type="date" placeholder="Fecha fin" name="fecha_fin">
            <label for="exampleFormControlSelect1">Categorias</label>
            <select class="form-control" id="exampleFormControlSelect1" name="id_categoria">
            <option value="">Selecciona categoría</option>  
            @foreach ($categorias as $cat)
                <option value="{{$cat->id}}">{{$cat->nombre}}</option>  
            @endforeach
            </select>
            <button type="submit">Enviar</button>
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
                            <td><strong>{{$a->producto}}</strong></td>
                            <td><strong>{{$a->precio}}</strong></td>
                            <td><strong>{{$a->nameCategoria->nombre}}</strong></td>
                            <td><strong>{{$a->nameUser->nombre}}</strong></td>
                            <td><strong>{{$a->vendido}}</strong></td>
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
                </table>
        </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      
    });
  });
</script>
@endsection