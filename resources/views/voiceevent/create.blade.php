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
                <label id="eventscounter">0/10 Events</label>
                <ul id="events"></ul>
            </div>
            <div class="form-group">
                <button type="button" id="vevent" class="btn btn-primary">Vorhandenes Event hinzufügen</button>
                <div id="voevents">
                    <!--<input type="text" id="eventsearch" onkeyup="searchEvent()">-->
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
                        <select class="form-control" name="duration" id="inputEventDuration">
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
                        <select class="form-control" name="ledStatus" id="inputEventLedStatus">
                            <option value="1">An</option>
                            <option value="0">Aus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputEventLedStatus">LED</label>
                        <ul>
                            @forelse($leds as $led)
                                <input type="radio" id="{{ $led->id }}" name="led" value="{{ $led->id }}">
                                <label for="{{ $led->id }}">{{ $led->gpio }}</label>
                                </br>
                            @empty
                                <p>Keine LED's</p>
                            @endforelse
                        </ul>
                    </div>
                    <button type="button" id="createEvent" class="btn btn-primary">Erstelle Event</button>
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

    function addEvent(event) {
        events++
        if(events <= 10) {
            $("#events").append("<li id='" + events + "'>" + event[1] + "<button type='button' onclick='removeEvent(" + events + ")'>Remove</button><input type='hidden' name='eventids[]' value='" + event[0] + "'></li>")
            $("#eventscounter").text(events + "/10 Events")
        }
    }

    function removeEvent(event_id) {
        $("#events>li#" + event_id).remove()
        events--
        $("#eventscounter").text(events + "/10 Events")
    }
 
    function getAllEvents() {

        $.ajax({
            type: "POST",
            url: "/getAllEvents",
            data: '_token = <?php echo csrf_token() ?>',
            success: function(data) {
                $("#eventlist").empty()
                data["events"].forEach(addToUl)
                function addToUl(event) {
                    $("#eventlist").append("<li id='" + event.id + "'><button type='button' onclick='addEvent([" + event.id + ", \"" + event.name + "\"])'>Add</button>" + event.name + "</li>")
                }
            }
        });

    }

    function createEvent() {
        var formData = $("form").serializeArray()
        console.log(formData)
        var data = {}
        data['_token'] = formData[0].value
        data['eventName'] = formData[2].value
        $("inputEventName").val("")
        data['duration'] = formData[3].value
        data['ledStatus'] = formData[4].value
        $("inputEventLedStatus").val("")
        data['led'] = formData[5].value
        $("input[name=led]").attr('checked',false);

        console.log(data)

        $.post("/event/create", data)
    }

    $(document).ready(function() {
        $("#vevent").click(function() {
            $("#voevents").css("display", "block")
            getAllEvents()
        })
        $("#createEvent").click(function() {
            $("#createform").css("display", "none")
            $("#voevents").css("display", "none")
            createEvent();
        })
        $("#nevent").click(function() {
            $("#createform").css("display", "block")
        })
    })

</script>

@endsection