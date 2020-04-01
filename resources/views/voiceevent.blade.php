@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <p><a href="{{ route('createvoiceeventget') }}">neues VoiceEvent erstellen</a></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">VoiceCommand</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($voiceevents as $voiceevent)
                    <tr>
                        <td scope="col">{{ $voiceevent->id }}</td>
                        <td>{{ $voiceevent->voiceCommand }}</td>
                    </tr>
                @empty
                    <p>keine VoiceEvents<p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection