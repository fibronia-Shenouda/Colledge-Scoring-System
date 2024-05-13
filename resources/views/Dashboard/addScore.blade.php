@extends('Dashboard.layout')

@section('title')
    Add Score
@endsection

@section('content')
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success" id="message">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-success" id="message">
                {{ session('error') }}
            </div>
        @endif
        <h2>Add Score</h2>
        <hr>

        <div class="fields">
            <form action="/add/score" method="POST" id="form">
                @csrf
                @method('PUT')
                <div class="form-gropu">
                    <label>Team <input name="team" id="team">
                        <input type="hidden" id="team_id" name="team_id">
                    </label>

                    <div class="dropdown">
                        <button class="dropdown-toggle dropdown" type="button" id="teamDropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span id="selectedTeamName" style="margin-left: 2%">Select team name</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="teamDropdownMenuButton">
                            @foreach ($teams as $team)
                                <a class="dropdown-item team-item" data-team-id="{{ $team->id }}"
                                    href="/add/scores/{{ $team->id }}">{{ $team->team_name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="from-group mt-3">
                        <label>Event Name</label>
                        <div class="dropdown">
                            <button class="dropdown-toggle dropdown" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="selectedEventName" style="margin-left: 2%">Select event</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @php
                                    $eventsCombination = array_combine($eventIds, $events);
                                @endphp
                                @unless (count($eventsCombination) == 0)
                                    @foreach ($eventsCombination as $id => $event)
                                        <a class="dropdown-item event-item"
                                            data-event="{{ $id }}">{{ $event }}</a>
                                    @endforeach
                                @else
                                    <span style="margin-left: 3%;color:rgb(68, 68, 68)">Select the team first.</span>
                                @endunless
                            </div>
                            <input name="event_id" type="hidden" id="event">
                        </div>

                        <hr>
                        <div class="add-score d-flex justify-content-between">
                            <div class="d-flex">
                                <label>Score</label>
                                <input type="number" name="score" placeholder="Score" class="form-control">
                            </div>
                            <button type="submit" class="add-events text-white"><i class="bi bi-plus"></i>Add
                                Score</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Get the team and store in hidden input
        document.querySelectorAll('.team-item').forEach(item => {
            item.addEventListener('click', event => {
                const selectedTeamName = event.target.innerText;
                const selectedTeamId = event.target.dataset.teamId;
                localStorage.setItem('team', selectedTeamName);
                localStorage.setItem('team_id', selectedTeamId);
            });
            document.getElementById('team').value = localStorage.getItem('team');
            document.getElementById('team_id').value = localStorage.getItem('team_id');
        });

        // Get the event and store in hidden input
        document.querySelectorAll('.event-item').forEach(item => {
            item.addEventListener('click', event => {
                const selectedEventName = event.target.innerText;
                const selectedEventId = event.target.dataset.event;
                document.getElementById('selectedEventName').innerText = selectedEventName;
                localStorage.setItem('event', selectedEventId);
                document.getElementById('event').value = localStorage.getItem('event');
            });
        });

        // Remove the local sorage when submit
        document.getElementById("form").addEventListener('submit', function() {
            localStorage.removeItem('team');
            localStorage.removeItem('event');
        });

        // Remove the local sorage when reload tha page
        document.addEventListener('DOMContentLoaded', function() {
            localStorage.removeItem('team');
            localStorage.removeItem('event');
        });
    </script>
@endsection
