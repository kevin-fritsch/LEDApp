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
                        <td><a href="{{ route('editledget', $led) }}">Edit</a></td>
                        <td><a href="#" data-toggle="modal" data-target="#deleteModal" data-whatever={{ $led->id }}>Delete</a></td>
                    </tr>
                @empty
                    <p>keine registrierten LED's<p>
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
                <h5 class="modal-title" id="deleteModalLabel">Willst du diese LED wirklich löschen?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                <form action="{{ route('deleteledpost') }}" method="POST">
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