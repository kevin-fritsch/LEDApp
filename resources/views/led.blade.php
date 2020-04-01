@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <p><a href="{{ route('createledget') }}">neue LED hinzufügen</a></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">GPIO</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($leds as $led)
                    <tr>
                        <td scope="col">{{ $led->id }}</td>
                        <td>{{ $led->gpio }}</td>
                    </tr>
                @empty
                    <p>keine registrierten LED's<p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection