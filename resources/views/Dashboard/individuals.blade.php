@extends('Dashboard.layout')

@section('title')
    Individuals
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
        <h2>Individuals</h2>
        <hr>
        <div class="mb-2" style="display:grid;grid-template-columns: 70% 30%">
            <form action="/individuals">
                <div class="search-container">
                    <input style="height: 40px" type="text" name="search" class="form-control search"
                        placeholder="Search for individual or member...">
                </div>
            </form>
            <div class="d-flex">
                <button class="rank h"><a href="/individuals?filter=high">Highest</a></button>
                <button class="rank l"><a href="/individuals?filter=low">Lowest</a></button>
                <button class="rank" style="margin-left: 3%"><a href="/individuals"><i
                            class="bi bi-arrow-clockwise"></i></a></button>
            </div>
        </div>
        <table class="table1">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>individual Name</th>
                    <th>Members</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @unless (count($individuals) == 0)
                    @foreach ($individuals as $individual)
                        @if ($individual->member2 == null)
                            @php
                                $rank++;
                            @endphp
                            <tr>
                                <td>{{ $rank }}</td>
                                <td>{{ $individual->team_name }}</td>
                                <td>{{ $individual->member1 }}</td>
                                @if ($individual->scores_sum_score)
                                    <td>{{ $individual->scores_sum_score }}</td>
                                @else
                                    <td>0</td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @else
                    <p style="font-size: 15px"><i class="bi bi-clock-history"></i> There are no individual teams joined yet.</p>
                @endunless
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
          {{ $individuals->links() }}
      </div>
    </div>
@endsection
