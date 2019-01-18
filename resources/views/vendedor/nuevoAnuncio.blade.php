@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Anuncio</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vendedor.store') }}">
                        @csrf
                        <input type="hidden" name="id_vendedor" value="{{  Auth::user()->id }}">
                        <div class="form-group row">
                            <label for="producto" class="col-md-4 col-form-label text-md-right">{{ __('Producto') }}</label>

                            <div class="col-md-6">
                                <input id="producto" type="text" class="form-control{{ $errors->has('producto') ? ' is-invalid' : '' }}" name="producto" value="{{ old('producto') }}" required autofocus>

                                @if ($errors->has('producto'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('producto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-right">Categoria</label>

                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('id_categoria') ? ' is-invalid' : '' }}" id="exampleFormControlSelect1" name="id_categoria">
                                    <option selected>...</option>
                                    @foreach($categorias as $c)
                                        <option>{{ $c->nombre }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_categoria'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id_categoria') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>

                            <div class="col-md-6">
                                <input id="precio" type="text" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" required>

                                @if ($errors->has('precio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('precio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-right">Estado</label>
    
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" id="exampleFormControlSelect1" name="estado">
                                        <option selected>...</option>
                                        <option>Nuevo</option>
                                        <option>Segunda mano</option>
                                    </select>
    
                                    @if ($errors->has('estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1" class="col-md-4 col-form-label text-md-right">Imagenes</label>
                            
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="img" required>
                                @if ($errors->has('img'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
    
                                <div class="col-md-6">
                                    <input id="descripcion" type="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" required>
    
                                    @if ($errors->has('descripcion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
