@extends('Authentication.layout')

@section('title')
    Who are you?
@endsection


@section('content')
    <div class="who-container">
        <p>Who are you?</p>
        <div class="btns" style="display: flex; column-gap:2%">
            <button style="background-color: #175CD3;"><a href="/login/admin">Admin</a></button>
            <button style="background-color: #1570EF;"><a href="/login/student/login">Student</a></button>
        </div>
    </div>
@endsection
