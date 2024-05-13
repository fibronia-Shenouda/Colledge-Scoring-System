@extends('Dashboard.layout')

@section('title')
    Results
@endsection

@section('content')
    {{-- Some interna styleing --}}
    <style>
        tr {
            display: grid;
            grid-template-columns: repeat(4, 25%);
            text-align: start;
        }

        td,
        th {
            text-align: start;
        }

        th {
            font-size: 3vh;
        }

        td {
            font-size: 2.5vh;
        }
    </style>

    <div class="form">
        <h2>Results</h2>
        <hr>
        <div class="mb-2" style="display:grid;grid-template-columns: 70% 30%">
            <form action="/results">
                <div class="search-container">
                    <input style="height: 40px" type="text" name="search" class="form-control search"
                        placeholder="Search for team or event...">
                </div>
            </form>
            <div class="d-flex">
                <button class="rank h"><a href="/results?filter=high">Highest</a></button>
                <button class="rank l"><a href="/results?filter=low">Lowest</a></button>
                <button class="rank" style="margin-left: 3%"><a href="/results"><i
                            class="bi bi-arrow-clockwise"></i></a></button>
            </div>
        </div>
        <table class="table1">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Team</th>
                    <th>Event</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @unless (count($results) == 0)
                    @foreach ($results as $result)
                        @php
                            $rank++;
                        @endphp
                        <tr>
                            <td>{{ $rank }}</td>
                            <td>{{ $result->team->team_name }}</td>
                            <td>{{ $result->event->name }}</td>
                            <td>{{ $result->score }}</td>
                        </tr>
                    @endforeach
                @else
                    <p style="font-size: 15px"><i class="bi bi-clock-history"></i> There is no scores added yet <a
                            class="add-score-link" href="/add/scores/">Add
                            Score
                            Now</a></p>
                @endunless
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $results->links() }}
        </div>
    </div>
@endsection
