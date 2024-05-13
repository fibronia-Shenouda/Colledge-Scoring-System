@extends('Dashboard.layout')

@section('title')
    Teams
@endsection

@section('content')

    {{-- Some internal styling --}}
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
        <h2>Teams</h2>
        <hr>
        <div class="mb-2" style="display:grid;grid-template-columns: 70% 30%">
            <form action="/teams">
                <div class="search-container">
                    <input style="height: 40px" type="text" name="search" class="form-control search"
                        placeholder="Search for team or member...">
                </div>
            </form>
            <div class="d-flex">
                <button class="rank h"><a href="/teams?filter=high">Highest</a></button>
                <button class="rank l"><a href="/teams?filter=low">Lowest</a></button>
                <button class="rank" style="margin-left: 3%"><a href="/teams"><i
                            class="bi bi-arrow-clockwise"></i></a></button>
            </div>
        </div>
        <table class="table1">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Team Name</th>
                    <th>Members</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @unless (count($teams) == 0)
                    @foreach ($teams as $team)
                        @if ($team->member2 != null)
                            @php
                                $rank++;
                            @endphp
                            <tr>
                                <td>{{ $rank }}</td>
                                <td>{{ $team->team_name }}</td>
                                <td>
                                    <select>
                                        <option style="color: rgb(142, 142, 142)">Members</option>
                                        @for ($i = 0; $i < 5; $i++)
                                            <option>{{ $team->{'member' . $i + 1} }}</option>
                                        @endfor
                                    </select>
                                </td>
                                @if ($team->scores_sum_score)
                                    <td>{{ $team->scores_sum_score }}</td>
                                @else
                                    <td>0</td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @else
                    <p style="font-size: 15px"><i class="bi bi-clock-history"></i> There are no teams joined yet.</p>
                @endunless
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $teams->links() }}
        </div>
    </div>
@endsection
