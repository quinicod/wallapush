<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        h1{
            font-size:30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Listado de ventas</h1>

    <div class="row">
        <div class="container">
                <table class="table table-striped"  id="myTable" data-order='[[0, "desc" ]]'>
                  <thead>
                      <tr>
                        <td align="center"><strong>Producto</strong></td>
                        <td align="center"><strong>Precio</strong></td>
                        <td align="center"><strong>Categoria</strong></td>
                        <td align="center"><strong>Vendedor</strong></td>
                        <td align="center"><strong>Vendido</strong></td>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($anuncios as $a)
                        @if($a->transaccion !=null)  
                        <tr>
                            <td>{{$a->producto}}</td>
                            <td>{{$a->precio}}</td>
                            <td>{{$a->nameCategoria->nombre}}</td>
                            <td>{{$a->nameUser->nombre}}</td>
                            <td>{{$a->vendido}}</td>
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
                </table>
        </div>
</div>
@section('script')
<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      
    });
  });
</script>
@endsection