@extends('Pages.layout')


@section('title')
    Profile
@endsection

@section('content')
    <div class="container-fluid mt-4 profile-container mb-4">
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

        @php
            $userName = ucfirst(auth()->user()->name);
        @endphp
        <div class="row top mb-2">
            <div class="col-3" style="height: 300px">
                <img class="card-img-top" style="border-radius: 20px"
                    src="{{ auth()->user()->photo ? asset('./storage/' . auth()->user()->photo) : asset('./assets/images/profile.png') }}"
                    alt="competition photo" style="height: 200px">
            </div>
            <div class="col-9">
                <div class="info">
                    <p class="name">{{ $userName }}</p>
                    <p class="email">Email: {{ auth()->user()->email }}</p>
                    <div class="d-flex justify-content-between">
                        <p class="phone_number">Phone number: {{ auth()->user()->phone_number }}</p>
                        <a href="/setting/{{ auth()->user()->id }}"><button class="setting"><i class="bi bi-gear-fill"></i>
                                Edit Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row desc">
            <p>Brief Description</p>
            <div class="line"></div>
            <div class="description">
                @if (auth()->user()->description)
                    <p style="color:rgb(48, 48, 48)">{{ auth()->user()->description }}</p>
                @else
                    <p style="width:100%;margin-left:13%;color:rgb(48, 48, 48)">No description added yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
