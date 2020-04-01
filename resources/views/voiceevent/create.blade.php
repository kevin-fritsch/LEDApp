@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <form method="POST" action="{{ route('createvoiceeventpost') }}">
            @csrf
            <div class="form-group">
                <label for="inputVoiceCommand">VoiceCommand</label>
                <input type="text" name="voiceCommand" class="form-control" id="inputVoiceCommand" placeholder="Licht an...">
            </div>
            <button type="submit" class="btn btn-primary">Absenden</button>
        </form>
    </div>
</div>

@endsection