@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="app">
            <h3>Add New Note</h3>
            <div class="input-single">
                <textarea id="note-textarea" placeholder="Create a new note by typing or using voice recognition." rows="6"></textarea>
            </div>
            <button id="start-record-btn" title="Start Recording">Start Recognition</button>
            <button id="pause-record-btn" title="Pause Recording">Pause Recognition</button>
            <button id="save-note-btn" title="Save Note">Save Note</button>
            <p id="recording-instructions">Press the <strong>Start Recognition</strong> button and allow access.</p>

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

        function getAllVoiceEvents() {

            $.ajax({
                type: "POST",
                url: "/getAllVoiceEvents",
                data: '_token = <?php echo csrf_token() ?>',
                success: function(data) {

                }
            });

        }

        function getVoiceEventQueue() {

        }

    </script>



@endsection