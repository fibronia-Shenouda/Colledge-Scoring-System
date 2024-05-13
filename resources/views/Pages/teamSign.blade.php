@extends('Pages/layout')

@section('title')
    Team Signin
@endsection

@section('content')
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success mt-3 container" id="message" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <p>Team Registration</p>
        <form action="/teamSign/create" method="POST" class="container form-container">
            @csrf
            @method('POST')
            <label>Team Name</label>
            <input type="text" name="team_name" class="form-control mb-3" value="{{ old('team_name') }}">
            @error('team_name')
                <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
            @enderror
            <label>Member Emails</label>
            <input type="text" name="member1" class="form-control mb-3" value="{{ old('member1') }}">
            @error('member1')
                <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
            @enderror
            <input type="text" name="member2" class="form-control mb-3" value="{{ old('member2') }}">
            @error('member2')
                <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
            @enderror
            <input type="text" name="member3" class="form-control mb-3" value="{{ old('member3') }}">
            @error('member3')
                <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
            @enderror
            <input type="text" name="member4" class="form-control mb-3" value="{{ old('member4') }}">
            @error('member4')
                <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
            @enderror
            <input type="text" name="member5" class="form-control mb-4" value="{{ old('member5') }}">
            @error('member5')
                <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <input type="hidden" name="events" class="form-control mb-4" value="{{ $events }}">
                @error('events')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="join-btn"><i class='bi bi-plus-lg'></i> Join</button>
            </div>
        </form>
    </div>
@endsection
