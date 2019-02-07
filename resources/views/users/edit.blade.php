@extends('layouts.app')
@section('content')
<div class="row justify-content-md-center" align= "center">
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>¡Error!</strong> Revise los campos obligatorios.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif
 
			<div class="panel panel-default" align= "center">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Saldo para {{$user->name}}</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('users.update',$user->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
							<div class="row" align= "center">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="integer" name="saldo" id="saldo" class="form-control input-sm" value="{{$user->saldo}}">
									</div>
								</div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
                                        @if($user->activated == 0)
                                            <p>Activar cuenta</p>
                                                <input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="1" 
                                                    {{ $user->actived == 1 }}>
                                            <p>Desactivar cuenta</p>
                                                <input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="0" checked="checked" 
                                                    {{ $user->actived == 0 }}>
                                        @endif
                                        @if($user->activated == 1)
                                            <p>Activar cuenta</p>
                                                <input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="1" checked="checked"
                                                    {{ $user->actived == 1 }}>
                                            <p>Desactivar cuenta</p>
                                                <input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="0" 
                                                    {{ $user->actived == 0 }}>
                                        @endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('users.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	
 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endsection