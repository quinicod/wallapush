@extends('layouts.app')
@section('content')

	<div class="row justify-content-md-center" align= "center">
		<div class="uper">
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
		</div>

		<section class="content">
			<div class="col-md-8 col-md-offset-2">
				<div class="card panel panel-default" align="center">
					<div class="panel-heading">
                		<div class="card-header">
							<h4 class="panel-title">Panel de Administración de Usuario: {{$user->name}}</h4>
						</div>
					</div>
					<div class="panel-body">					
						<div class="card-body table-container">
							<form method="POST" action="{{ route('users.update',$user->id) }}"  role="form">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="PATCH">
								<div class="form-group row" align= "center">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
										<strong>Saldo</strong>
											<input type="integer" name="saldo" id="saldo" class="form-control input-sm" placeholder="Introduzca saldo" value="{{$user->saldo}}">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											@if($user->activated == 0)
												<strong>Activar</strong> <p>cuenta</p>
													<input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="1" 
														{{ $user->actived == 1 }}>
												<strong>Desactivar</strong> <p>cuenta</p>
													<input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="0" 
														{{ $user->actived == 0 }}>
											@endif
											@if($user->activated == 1)
												<strong>Activar</strong> <p>cuenta</p>
													<input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="1"
														{{ $user->actived == 1 }}>
												<strong>Desactivar</strong> <p>cuenta</p>
													<input type="radio" name="actived" id="actived" class="form-control input-sm col-md-2" value="0" 
														{{ $user->actived == 0 }}>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group row">
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