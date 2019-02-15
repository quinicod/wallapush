<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <h1 class="text-center">Listado de ventas</h1>

    <div class="row">
        <div class="container">
                <table class="table table-striped" >
                  <thead>
                      <tr>
                        <td align="center"><strong>Producto</strong></td>
                        <td align="center"><strong>Precio</strong></td>
                        <td align="center"><strong>Categoria</strong></td>
                        <td align="center"><strong>Vendedor</strong></td>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($anuncios as $a)
                        @if($a->transaccion !=null)  
                        <tr>
                            <td>{{$a->producto}}</td>
                            <td>{{$a->precio}}</td>
                            <td>{{$a->nameCategoria->nombre}}</td>
                            <td>{{$a->nameUser->name}}</td>
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
                </table>
        </div>
</div>