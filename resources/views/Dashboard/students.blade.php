@extends('Dashboard.layout')

@section('title')
    Students
@endsection

@section('content')

    {{-- Some internal styling --}}
    <style>
        tr {
            display: grid;
            grid-template-columns: 20% 15% 30% 20% 15%;
            text-align: start;
        }

        th {
            font-size: 3vh;
        }

        td {
            display: flex;
            align-items: center;
            font-size: 2.5vh;
        }

        td,
        th {
            text-align: start;
        }
    </style>

    <div class="form">
        <h2>Students</h2>
        <hr>
        <table class="table1">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Team Name</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @unless (count($students) == 0)
                    @foreach ($students as $student)
                        <td><img class="w-50"
                                src="{{ $student->photo ? asset('./storage/' . $student->photo) : asset('./assets/images/profile.png') }}"
                                alt=""></td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>
                            @php
                                $joinedTeam = false;
                            @endphp
                            @foreach ($teams as $team)
                                @if (
                                    $student->email == $team->member1 ||
                                        $student->email == $team->member2 ||
                                        $student->email == $team->member3 ||
                                        $student->email == $team->member4 ||
                                        $student->email == $team->member5)
                                    {{ $team->team_name }}
                                    @php
                                        $joinedTeam = true;
                                        break; // no need to continue looping once we found the team
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$joinedTeam)
                                Has not joined any team yet
                            @endif
                        </td>
                    @endforeach
                @else
                    <p style="font-size: 15px"><i class="bi bi-clock-history"></i> There are no students joined yet.</p>
                @endunless
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $students->links() }}
        </div>
    </div>
@endsection

{{-- @foreach ($teams as $team)
                            @if ($student->email == $team->member1 || $student->email == $team->member2 || $student->email == $team->member3 || $student->email == $team->member4 || $student->email == $team->member5)
                                <td>{{ $team->team_name }}</td>
                            @else
                                <td>Has not joined any team yet</td>
                            @endif
                        @endforeach --}}
