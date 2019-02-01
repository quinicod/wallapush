@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 50px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Nombre</td>
          <td>Email</td>
          <td>Rol</td>
          <td>Localidad</td>
          <td>Saldo</td>
          <td>Estado de la cuenta</td>
          <td colspan="2">Acción</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
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
            <td><a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
            <td>    
                                    <!-- Button trigger modal-->
                  @if($user->role=='user')
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete{{$user->id}}">Borrar usuario</button>
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
                    El admin no puede ser eliminado.
                  @endif
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection