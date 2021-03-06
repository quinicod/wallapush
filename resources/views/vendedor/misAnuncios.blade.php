@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session('message'))
        <div class="alert alert-{{ session('message')[0] }}"> {{ session('message')[1] }} </div> 
    @endif
    <div class="row">
        <div class="col-md-2 offset-md-9">
        <form action="{{ route('filtroMisAnuncios') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group" style="margin-right: 3%;">
                    <select class="form-control" id="exampleFormControlSelect1" name="eleccion">
                      <option value="0">Activos</option>
                      <option value="1">Vendidos</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-angle-right"></i></button>
            </form>
        </div>
    </div> <br>
    
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
                                @if(strlen($a['producto']) > 20)
                                    <h5><strong>{{ substr($a['producto'],0,20) }}... {{ $a['precio'] }}€</strong></h5>
                                @else 
                                    <h5><strong>{{ $a['producto'] }} {{ $a['precio'] }}€</strong></h5>
                                @endif
                                <div id="el_div{{ $a['id']}}">
                                    @if(strlen($a['descripcion']) > 100)
                                        <p class="card-text">{{substr($a['descripcion'],0,100)}}...</p>
                                    @else 
                                        <p class="card-text">{{$a['descripcion']}}</p>
                                    @endif
                                </div> <br>
                                @if($a['vendido'] == false)
                                <a href="" data-toggle="modal" data-target="#editModal{{ $a['id'] }}">Editar</a> 
                                <div class="float-md-right">

                                            
                                            <!-- Button trigger modal-->

                                <button class="enlace" data-toggle="modal" data-target="#modalConfirmDelete">Borrar</button>

                                <!--Modal: modalConfirmDelete-->
                                <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                                    <!--Content-->
                                    <div class="modal-content text-center">
                                    <!--Header-->
                                    <div class="modal-header d-flex justify-content-center btn-danger">
                                        <p class="heading"><strong>¿Quieres borrar este anuncio?</strong></p>
                                    </div>

                                    <!--Body-->
                                    <div class="modal-body">

                                        <i class="fas fa-times fa-4x animated rotateIn equis"></i>
                                        <form action="{{ route('vendedor.destroy', ['id' => $a['id']]) }}" method="POST" id="formDelete">
                                            @csrf   
                                            @method('DELETE')                                 
                                        </form>

                                    </div>

                                    <!--Footer-->
                                    <div class="modal-footer flex-center">
                                    <button type="submit" class="btn  btn-outline-danger" form="formDelete">Si</button>
                                        <a href="" class="btn  btn-danger waves-effect">No</a> 
                                    </div>
                                    </div>
                                    <!--/.Content-->
                                </div>
                                </div>
                                <!--Modal: modalConfirmDelete-->
                                                           
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
                    <h4>No tienes anuncios vendidos.</h4>
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