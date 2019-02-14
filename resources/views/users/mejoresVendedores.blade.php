@extends('layouts.app')

@section('content')
  <style>
    .uper {
      margin-top: 50px;
    }
  </style>
  <!-- Mensaje de alerta -->
  <div class="container uper">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
  </div>

  <div class="container-fluid">
    <div class="row">
        <div class="col-md-7 offset-1">
            <h4>Mejores vendedores</h4>
        </div>
        <div class="col md 4">
            <a href="{{ route('users.index', 'admin') }}" class="btn btn-outline-secondary">Listado</a>
            <a href="{{ route('listado1') }}" class="btn btn-outline-warning">Mejores Vendedores</a>
            <a href="{{ route('listado3') }}" class="btn btn-outline-success">Mejor valorados</a>
        </div>
    </div>
  </div> <br><br>
  <!-- Lista de usuarios -->

  <div class="container">
    <table class="table table-striped"  id="myTable" data-order='[[ 2, "desc" ]]'>
      <thead>
          <tr>
            <td align="center"><strong>Nombre</strong></td>
            <td align="center"><strong>Saldo</strong></td>
            <td align="center"><strong>Ganado con ventas</strong></td>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
          <tr>
              <td align="center"><strong>{{$user->name}}</strong></td>
              <td align="center">{{$user->saldo}}</td>
              @if($user->tieneAnuncio == '[]')
                <td align="center">0 €</td>
              @else
                @php
                    $saldo=0;
                @endphp
                @foreach($user->tieneAnuncio as $a)
                  @if($a->vendido == true)
                    @php
                        $saldo+=$a->precio;
                    @endphp
                  @endif
                @endforeach
                <td align="center">{{ $saldo }} €</td>
              @endif
          </tr>
          @endforeach
      </tbody>
    </table>
    <!-- Paginación -->

    <!-- Fin - Paginación -->
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