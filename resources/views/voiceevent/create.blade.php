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
            <div class="form-group">
                <label>0/10 Events</label>
            </div>
            <div class="form-group">
                <button type="button" id="vevent" class="btn btn-primary">Vorhandenes Event hinzufügen</button>
                <div id="voevents">
                    <input type="text" id="eventsearch" onkeyup="searchEvent()">
                    <ul id="eventlist"></ul>
                </div>
            </div>
            <div class="form-group">
                <button type="button" id="nevent" class="btn btn-primary">Neues Event erstellen</button>
                <div id="createform">
                    <div class="form-group">
                        <label for="inputEventName">Name</label>
                        <input type="text" name="eventName" class="form-control" id="inputEventName">
                    </div>
                    <div class="form-group">
                        <label for="inputEventDuration">Länge (in Sekunden)</label>
                        <select class="form-control" id="inputEventDuration">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputEventLedStatus">LED Status</label>
                        <select class="form-control" id="inputEventLedStatus">
                            <option value="1">An</option>
                            <option value="0">Aus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <ul>
                            @forelse($leds as $led)
                                <li>{{ $led->gpio }}</li>
                            @empty
                                <p>Keine LED's</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Absenden</button>
        </form>
    </div>
</div>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var events = 0;

    function getAllEvents() {

        $.ajax({
            type: "POST",
            url: "/getAllEvents",
            data: '_token = <?php echo csrf_token() ?>',
            success: function(data) {
                console.log(data)
            }
        });

    }

    $(document).ready(function() {
        $("#vevent").click(function() {
            $("#voevents").css("display", "block")
            getAllEvents()
        })
        $("#nevent").click(function() {
            $("#createform").css("display", "block")
        })
    })

</script>

@endsection