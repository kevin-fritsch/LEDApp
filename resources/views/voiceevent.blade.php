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
                        <td><a href="{{ route('editvoiceeventget', $voiceevent) }}">Edit</a></td>
                        <td><a href="#" data-toggle="modal" data-target="#deleteModal" data-whatever={{ $voiceevent->id }}>Delete</a></td>
                    </tr>
                @empty
                    <p>keine VoiceEvents<p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Willst du dieses VoiceEvent wirklich löschen?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                <form action="{{ route('deletevoiceeventpost') }}" method="POST">
                    @csrf
                    <input type="hidden" id="ido" name="id">
                    <button type="submit" class="btn btn-danger">Löschen</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var recipient = button.data('whatever');
        var modal = $(this);
        modal.find("#ido").val(recipient);
    });
</script>

@endsection