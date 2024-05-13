@extends('Authentication.layout')

@section('title')
    Student Register
@endsection

@section('content')
    <div class="form">
        <form action="/student/regist" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="text" class="form-control" name="email" placeholder="Enter your email"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone_number" placeholder="Enter your phone number"
                    value="{{ old('phone_number') }}">
                @error('phone_number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password"
                    value="{{ old('password') }}">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="btn-container">
                <p style="color: #909090">Already have an <span><a style="color: #53B1FD"
                            href="/login/student/login">account?</a></span></p>
                <button type="submit" class="form-btn"><i class="bi bi-person-plus-fill"></i> Sign Up</button>
            </div>
        </form>
    </div>
@endsection
