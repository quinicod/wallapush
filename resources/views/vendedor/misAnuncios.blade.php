@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif
            @forelse($anuncios as $index)
                <div class="row justify-content-md-center">
                @foreach($index as $a)
                    <div class="col-md-3">
                        <div class="card">
                        @if($a['imagenes'] == '[]')
                            <img class="card-img-top" src="" alt="Card image cap">
                        @else
                        <a href="">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($a['imagenes'] as $index => $i)
                                        @if($index == 0)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        @else
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"></li>
                                        @endif
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                @foreach($a['imagenes'] as $index => $i)
                                    @if($index == 0)
                                        <div class="carousel-item active">
                                            <img src="{{asset('../storage/app/anuncios/'.$i['img'])}}" class="d-block w-100">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img src="{{asset('../storage/app/anuncios/'.$i['img'])}}" class="d-block w-100">
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </a>
                        @endif
                            <div class="card-body">
                                <h5><strong>{{ substr($a['producto'],0,20) }}... {{ $a['precio'] }}€</strong></h5>
                                <div id="el_div{{ $a['id']}}">
                                        <p class="card-text">{{substr($a['descripcion'],0,150)}}...</p>
                                </div> <br>
                                @if($a['vendido'] == false)
                                <a href="" data-toggle="modal" data-target="#editModal{{ $a['id'] }}">Editar</a> 
                                <div class="float-md-right">

                                            <form action="{{ route('vendedor.destroy', ['id' => $a['id']]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="enlace" type="submit">Borrar</button>
                                            </form>
                                                           
                                          <!-- Modal -->
                                          <div class="modal fade" id="editModal{{ $a['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Editor Anuncio</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{ route('vendedor.update', ['id' => $a["id"]]) }}" id="edit{{ $a['id'] }}" enctype="multipart/form-data" onSubmit="arrayImg({{ $a['id'] }})">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="producto" class="col-md-4 col-form-label text-md-right">{{ __('Producto') }}</label>
                                    
                                                                <div class="col-md-6">
                                                                <input id="producto" type="text" value="{{ $a['producto'] }}" class="form-control{{ $errors->has('producto') ? ' is-invalid' : '' }}" name="producto" value="{{ old('producto') }}" required autofocus>
                                    
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
                                                                            @if($c->id == $a['id_categoria'])
                                                                                <option value="{{ $c->id }}" selected>{{ $c->nombre }}</option>
                                                                            @else
                                                                                <option value="{{ $c->id }}" >{{ $c->nombre }}</option>
                                                                            @endif
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
                                                                <input id="precio" type="text" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" value="{{ $a['precio'] }}" required>
                                    
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
                                                                        <select class="form-control{{ $errors->has('nuevo') ? ' is-invalid' : '' }}" id="exampleFormControlSelect1" name="nuevo">
                                                                            @if($a['nuevo'] == 1)
                                                                                <option value="1" selected>Nuevo</option>
                                                                                <option value="0">Segunda mano</option>
                                                                            @else
                                                                                <option value="0" selected>Segunda mano</option>
                                                                                <option value="1" >Nuevo</option>
                                                                            @endif
                                                                        </select>
                                        
                                                                        @if ($errors->has('nuevo'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('nuevo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div> <br><br>

                                                                <div class="row justify-content-md-center">
                                                                    @foreach($a['imagenes'] as $i)
                                                                    
                                                                        <div class="col text-center">
                                                                        <img src="{{asset('../storage/app/anuncios/'.$i['img'])}}" id="{{ $i['id'] }}" class="imgBorrado"><br>
                                                                            {{-- <a href="{% url 'borrarRespuesta' r.id %}"><button class="btn btn-danger btn-xs bottonBorrar offset-md-11"><i class="fas fa-times"></i></button></a> --}}
                                                                           <a onclick="borrar('{{ $i['id'] }}')"><i class="fas fa-times"></i></a>
                                                                        </div>
                                                                    
                                                                    @endforeach
                                                                </div> <br><br>
                                                                 <div class="form-group row offset-md-2">
                                                                    <label for="exampleFormControlFile1">Imagenes</label>
                                                                    <div class="col-md-10">
                                                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="image/*" name="img[]" multiple>
                                                                        @if ($errors->has('img'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('img') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div> <br><br>
                                    
                                                            <div class="form-group row">
                                                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                        
                                                                    <div class="col-md-6">
                                                                    <textarea class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" rows="3" name="descripcion" required>{{ $a['descripcion'] }}</textarea>
                                        
                                                                        @if ($errors->has('descripcion'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('descripcion') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                            </div>
                                                            <input type="hidden" id="imgB{{ $a['id'] }}" name="imgBorrado">
                                                        </form>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                  <button type="submit" class="btn btn-primary" form="edit{{ $a['id'] }}">Guardar Cambios</button>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        
                                </div>
                                @else
                                    <div class="float-md-right">
                                        <p class="vendido">Vendido</p>
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                <br>
            @empty
                <div class="text-center">
                    <br><br>
                    <h4>No tienes anuncios publicados.</h4>
                    <a href="{{ route('vendedor.create') }}">Publica uno Aqui!</a>
                </div>
            @endforelse

<script type="text/javascript">
    var imgBorrado = new Array();
    function borrar(i){
        var img = document.getElementById(i);
        if(img.style.opacity == 0.5){
            img.style.opacity = 1;
            var deleted = imgBorrado.indexOf(i);
            imgBorrado.splice( deleted, 1 );
        }else{
            img.style.opacity = 0.5;
            imgBorrado.push(i);
        }
    }
    function arrayImg(id){
        var imgB = imgBorrado.toString();
        document.getElementById("imgB"+id).value = imgB;
        
    }
</script>
@endsection
