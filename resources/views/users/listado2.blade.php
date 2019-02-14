@extends('layouts.app')
@section('content')
<div>
    <form action="{{route('listado2')}}" method="POST">
        @csrf
        <div class="bx--form-item">
            <div class="bx--date-picker bx--date-picker--simple bx--date-picker--short">
                <div class="bx--date-picker-container">
                    <label for="date-picker-4" class="bx--label">Date Picker label</label>
                    <input type="text" name="fini" id="fini" class="bx--date-picker__input" pattern="\d{1,2}/\d{4}" placeholder="mm/yyyy" data-date-picker-input/>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection