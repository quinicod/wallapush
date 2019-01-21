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
              
                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  @if($user->role=='user')
                    <button class="btn btn-danger" type="submit">Delete</button>
                  @endif
                  @if($user->role == 'admin')
                    El admin no puede ser eliminado.
                  @endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection