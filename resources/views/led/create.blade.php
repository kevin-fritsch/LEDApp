@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <form method="POST" action="{{ route('createledpost') }}">
            @csrf
            <div class="form-group">
                <label for="inputGPIO">GPIO</label>
                <input type="text" name="gpio" class="form-control" id="inputGPIO">
            </div>
            <button type="submit" class="btn btn-primary">Absenden</button>
        </form>
    </div>
</div>

@endsection