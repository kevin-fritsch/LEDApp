@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="app">
            <div class="table-responsive">
                <table id="queue" class="table">
                    <thead>
                        <tr>
                            <th scope="col">VoiceEvent</th>
                            <td scope="col">Momentaner Stand</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="start-button">
                <button id="start-record-btn" title="Start">Start</button>
            </div>
            <div class="input-single">
                <textarea id="note-textarea" rows="1"></textarea>
            </div>

            <!--<button id="pause-record-btn" title="Pause Recording">Pause Recognition</button>
            <button id="save-note-btn" title="Save Note">Save Note</button>
            <p id="recording-instructions">Press the <strong>Start Recognition</strong> button and allow access.</p>-->

            <div class="allVoiceEvents">
                <ul id="voiceevents">
                </ul>
            </div>
        </div>
        <!-- Auflistung aller VoiceEvents in einer Warteschlange -->
        <!-- Bei Button klick soll ein Voiceeingabe erfolgen und entweder bei einem gefundenem Event oder nach ein paar Sekunden stoppen -->
        <!-- Websockets, AJAX Abfrage und Aufruf -->



    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/js/spech_to_text_script.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#note-textarea").on("change keyup paste", function() {

        })

        function getAllVoiceEvents() {

            $.ajax({
                type: "POST",
                url: "/getAllVoiceEvents",
                data: '_token = <?php echo csrf_token() ?>',
                success: function(data) {
                    let voiceevents = data.voiceevents
                    voiceevents.forEach(voiceevent => $("#voiceevents").append("<li>" + voiceevent.voiceCommand + "<button type='button' onclick='addToQueue(" + voiceevent.id + ")'>Add to queue</button></li>"))
                }
            });

        }

        function addToQueue(voiceeventid) {
            $.ajax({
                type: 'POST',
                url: '/addToQueue',
                data: {
                    '_token':  '<?php echo csrf_token() ?>',
                    'voiceevent_id': voiceeventid
                },
                success: function () {
                    $("#queue tbody").html("");
                    getVoiceEventQueue()
                }
            })

        }

        function getVoiceEventQueue() {
            $.ajax({
                type: 'POST',
                url: '/getVoiceEventQueue',
                data: '_token = <?php echo csrf_token() ?>',
                success: function(data) {
                    let voiceevents = data.voiceevents
                    voiceevents.forEach(appendToTable)
                    function appendToTable(voiceevent) {
                        var appendTo
                        if($("#queue tr:last").length) {
                            appendTo = $("#queue tbody")
                        } else {
                            appendTo = $("#queue tbody")
                        }
                        $.ajax({
                            type: 'POST',
                            url: '/getVoiceEvent',
                            data: { '_token': '<?php echo csrf_token() ?>',
                                'id': voiceevent.voiceevent_id
                            },
                            success: function (event) {
                                appendTo.append("<tr><td>" + event.voiceCommand + "</td><td>" + voiceevent.current + "</td></tr>")
                            }
                        })
                    }
                }
            })
        }

        function getVoiceEvent(id) {
            $.ajax({
                type: 'POST',
                url: '/getVoiceEvent',
                data: { '_token': '<?php echo csrf_token() ?>',
                        'id': id
                        },
                success: function (voiceevent) {
                    console.log(voiceevent)
                    return voiceevent
                }
            })
        }

        getAllVoiceEvents()
        getVoiceEventQueue()

    </script>



@endsection
