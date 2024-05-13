@extends('Dashboard.layout')

@section('title')
    Edit Competition
@endsection

@section('content')
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success" id="message">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" id="message">
                {{ session('error') }}
            </div>
        @endif
        {{-- Title --}}
        <h2>Edit {{ $competition->name }}</h2>
        <hr>

        <div class="fields">
            {{-- Editing From --}}
            <form action="/update/{{ $competition->id }}/competition" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- Competition Editing form --}}
                <div class="form-group">
                    <label>Competition Name</label>
                    <input type="text" class="form-control" placeholder="Enter competition name" name="name"
                        value="{{ $competition->name }}">
                </div>

                <div class="form-group d-flex">
                    <div>
                        <label>Competition Image</label>
                        <input type="file" class="form-control-file" name="photo">
                        <img class="card-img-top"
                            src="{{ $competition->photo ? asset('./storage/' . $competition->photo) : asset('./assets/images/default.png') }}"
                            alt="competition photo" style="height: 200px">
                    </div>
                    <div class="mt-2"
                        style="display: flex;flex-direction:column;font-size:3vh;color:#194185;margin-left:5%">
                        @if ($competition->is_team == 0)
                            <div>
                                <input type="radio" name="is_team" value="0" checked> Individual
                            </div>
                            <div>
                                <input type="radio" name="is_team" value="1"> Team
                            </div>
                        @else
                            <div>
                                <input type="radio" name="is_team" value="0"> Individual
                            </div>
                            <div>
                                <input type="radio" name="is_team" value="1" checked> Team
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    <label>Competition Description</label>
                    <textarea type="text" placeholder="Enter competition description" name="description" cols="30" rows="5"
                        class="form-control">
              {{ $competition->description }}
            </textarea>
                    @error('description')
                        <p class="text-danger" style="font-size: 15px;text-align:start">{{ $message }}</p>
                    @enderror
                </div>
        </div>

        {{-- Events Form --}}
        @php
            $count = 0;
        @endphp
        <div class="fields mt-4">
            @unless (count($competition->events) != 0)
                <p style="font-size: 3vh;text-align:start"><i class="bi bi-clock-history"></i> No events added yet. <br><a style="color: #194185;text-decoration:underline;" href="/add/events/{{$competition->id}}">Add Now</a></p>
            @else
                @php
                    $count = 0;
                @endphp
                @foreach ($competition->events as $event)
                    @php
                        $count++;
                    @endphp
                    <div>
                        <h2 style="font-size: 3.5vh">Event {{ $count }}</h2>
                        <hr>
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" class="form-control" placeholder="Enter event name"
                                name={{"name$event->id"}} value="{{ $event->name }}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Event Description</label>
                                <textarea class="form-control" name={{"description$event->id"}}
                                    placeholder="Enter the event description" cols="30" rows="5">{{ $event->description }}</textarea>
                            </div>
                            <div class="mt-2" style="display: flex;flex-direction:column;font-size:3vh;color:#194185">
                                <div>
                                    <input type="radio" name={{"is_academic$event->id"}} value="1"
                                        {{ $event->is_academic == 1 ? 'checked' : '' }}>
                                    Academic
                                </div>
                                <div>
                                    <input type="radio" name={{"is_academic$event->id"}} value="0"
                                        {{ $event->is_academic == 0 ? 'checked' : '' }}>
                                    Sport
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endforeach
            @endunless
        </div>
        <div class="d-flex justify-content-end p-3">
            <button type="submit" class="sign-btn text-white"
                style="background-color: #4FACFC; border-radius:10px;font-size:23px;padding: 0.5% 2%">Change <i
                    class="bi bi-check"></i></button>
        </div>
        </form>
    </div>
@endsection
