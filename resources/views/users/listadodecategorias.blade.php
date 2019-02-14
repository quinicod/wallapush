@extends('layouts.app')
@section('content')
<div class="container uper">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
</div>
<div>
    <form action="{{route('listado2')}}" method="POST">
        @csrf
        <div class="bx--form-item">
            <div class="bx--date-picker bx--date-picker--simple bx--date-picker--short">
                <div class="bx--date-picker-container">
                    <label for="date-picker-4" class="bx--label">Fecha inicio</label>
                    <input type="date" name="fecha_ini" class="bx--date-picker__input">
                    <label for="date-picker-4" class="bx--label">Fecha fin</label>
                    <input type="date" name="fecha_fin" class="bx--date-picker__input">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection