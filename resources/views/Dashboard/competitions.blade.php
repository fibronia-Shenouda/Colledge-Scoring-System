@extends('Dashboard.layout')

@section('title')
    Competitions
@endsection

@section('content')
    <style>
        .add-competition-link {
            color: #194185;
            background-color: #f4f4f4;
            padding: 0.5%;
            font-size: 2.4vh;
            border-radius: 7px;
        }

        .add-competition-link:hover {
            background: #194185;
            color: #f4f4f4;
        }

        th {
            font-size: 3vh;
        }

        td {
            font-size: 2.5vh;
        }
    </style>
    <div class="container form">
        <div class="d-flex justify-content-between pt-3 pb-2" style="overflow-x: hidden">
            <h2>Competitions</h2>
            <div class="d-flex">
                <form action="/competitions/dashboard">
                    <div class="search-container">
                        <input style="height: 40px" type="text" name="search" class="form-control search"
                            placeholder="Search...">
                    </div>
                </form>
                <form action="/competitions/dashboard">
                    <input type="hidden" name="search" value=" ">
                    <button type="submit" class="btn" style="height: 40px;width:80px;text-align:center">All</button>
                </form>
            </div>
        </div>
        <table class="table1">
            <thead>
                <tr>
                    <th style="border-top-left-radius: 20px; text-align:start">Competition</th>
                    <th style="text-align:start">Events</th>
                    <th style="border-top-right-radius: 20px">Action</th>
                </tr>
            </thead>
            <tbody>
                @unless (count($competitions) == 0)
                    @foreach ($competitions as $competition)
                        <tr>
                            <td>{{ $competition->name }}</td>
                            <td>
                                <select>
                                    <option style="color: rgb(142, 142, 142)">Events</option>
                                    @foreach ($competition->events as $event)
                                        <option value="event2">{{ $event->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <form action="/delete/competition/{{ $competition->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-flex">
                                        <div class="update-btn"><i class="text-white bi bi-pencil-square"></i> <a
                                                href="/update/competition/{{ $competition->id }}">Update</a></div>
                                        <button style="background-color: #D83C3D" type="submit"><i
                                                class="bi bi-trash-fill"></i>
                                            Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p style="font-size: 15px"><i class="bi bi-clock-history"></i> There is no competitions added yet <a
                            class="add-competition-link" href="/add/competition">Add Competitions Now</a></p>
                @endunless
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $competitions->links() }}
        </div>
    </div>
@endsection
