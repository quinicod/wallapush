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
            <h4>Listado de usuarios</h4>
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
    <table class="table table-striped"  id="myTable" data-order='[[ {{ $orden }}, "desc" ]]'>
      <thead>
          <tr>
            <td align="center"><strong>Nombre</strong></td>
            <td align="center"><strong>Email</strong></td>
            <td align="center"><strong>Rol</strong></td>
            <td align="center"><strong>Localidad</strong></td>
            <td align="center"><strong>Saldo</strong></td>
            <td align="center"><strong>Estado de la cuenta</strong></td>
            <td align="center"><strong>Acciones de administración</strong></td>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
          <tr>
              <td><strong>{{$user->name}}</strong></td>
              <td>{{$user->email}}</td>
              <td>{{$user->role}}</td>
              <td>{{$user->localidad}}</td>
              <td>{{$user->saldo}}</td>
              <td>
                @if($user->actived == 1)
                  <p>Activada</p>
                @else
                  <p>Desactivada</p>
                @endif
              </td>
              <td><a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
 
                                      <!-- Button trigger modal-->
                    @if($user->role=='user')
                      <button class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete{{$user->id}}"><span class="glyphicon glyphicon-trash"></span></button>
                    @endif
                    <!--Modal: modalConfirmDelete-->
                    <div class="modal fade" id="modalConfirmDelete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                        <!--Content-->
                        <div class="modal-content text-center">
                          <!--Header-->
                          <div class="modal-header d-flex justify-content-center btn-danger">
                            <p class="heading"><strong>Este usuario puede tener anuncios publicados.<br>¿Seguro que quiere eliminarlo?<br><br>NOTA: Se eliminarán también los anuncios asociados al usuario.</strong></p>
                          </div>

                          <!--Body-->
                          <div class="modal-body">

                            <i class="fas fa-times fa-4x animated rotateIn equis"></i>
                            <form action="{{ route('users.destroy', $user->id)}}" method="POST" id="formDelete{{$user->id}}">
                                @csrf   
                                @method('DELETE')                                 
                            </form>  
                          </div>

                          <!--Footer-->
                          <div class="modal-footer flex-center">
                            
                            <button type="submit" class="btn  btn-outline-danger" form="formDelete{{$user->id}}">Si</button>
                            <a href="" class="btn btn-danger waves-effect">No</a> 
                          </div>
                        </div>
                        <!--/.Content-->
                      </div>
                    </div>
                    <!--Modal: modalConfirmDelete-->
                    @if($user->role == 'admin')
                      <strong>El admin no puede ser eliminado.</strong>
                    @endif
              </td>
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