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
        <div class="col-md-6 offset-1">
            <h4>Los mejores valorados</h4>
        </div>
        <div class="col md 4">
            <a href="{{ route('users.index', 'admin') }}" class="btn btn-outline-secondary">Listado</a>
            <a href="{{ route('listado1') }}" class="btn btn-outline-warning">Mejores Vendedores</a>
            <a href="{{ route('listado2') }}" class="btn btn-outline-info">Ventas por Categoria</a>
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
            <td align="center"><strong>Media Valoraciones</strong></td>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
          <tr>
              <td align="center"><strong>{{$user->name}}</strong></td>
              @if($user->anuncios=='[]')
                <td align="center">No tiene valoraciones</td>
              @else
                @php
                    $valoraciones=0;
                    $cont=0
                @endphp
                @foreach($user->anuncios as $a)
                    @if($a->transaccion != null)
                        @if($a->transaccion->valoracion != null)
                            @php
                                $valoraciones+=$a->transaccion->valoracion;
                                $cont+=1;
                            @endphp
                        @endif
                    @endif
                @endforeach
                @php
                    if($valoraciones != 0){
                        $valoraciones=$valoraciones/$cont;
                    }
                @endphp
                @if($valoraciones != 0)
                    <td align="center">{{ $valoraciones }}</td>
                @else
                    <td align="center">No tiene valoraciones</td>
                @endif
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