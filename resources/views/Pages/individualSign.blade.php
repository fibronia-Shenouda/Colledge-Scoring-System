@extends('Pages/layout')

@section('title')
    Individual Signin
@endsection

@section('content')
    <div class="form">
        @if (session('success'))
            <div class="alert alert-success mt-3 container" id="message" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mt-3 container" id="message" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <p>Individual Registration</p>
        <form action="/individualSign/create" method="POST" class="container form-container">
            @csrf
            @method('POST')
            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="team_name" class="form-control mb-3" value="{{ old('team_name') }}">
                @error('team_name')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Member Emails</label>
                <input type="text" name="member1" class="form-control mb-4" value="{{ old('member1') }}">
                
                @error('member1')
                    <p class="text-danger" style="text-align: left;font-size:15px">{{ $message }}</p>
                @enderror
            </div>
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
