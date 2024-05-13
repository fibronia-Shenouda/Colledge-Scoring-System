@extends('Pages/layout')

@section('title')
    Home
@endsection

@section('content')
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
    <div class="landing" style="background-image: url({{ asset('./assets/images/landing.png') }})">
        <p> Dare to compete, excel, and ignite your
            <br>journey to success with us! <br>
            @auth
                @if (auth()->user()->priviledge == 'student')
                    <button class="join-btn"><a style="text-decoration: none; color:white" href="#competitions">Start
                            competing</a></button>
                @endif
            @else
                <button class="join-btn"><a style="text-decoration: none; color:white" href="/login">JOIN US</a></button>
            @endauth
        </p>
    </div>
    <div class="home-content" id="competitions">
        <p>Available Competition</p>
        <hr>
        <div class="comp container">
            <div class="container">
                <form action="/">
                    <div class="search-container">
                        <input type="text" name="search" class="form-control search"
                            placeholder="Search for Competitions...">
                        <div>
                            <button class="search-btn" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                @unless (count($competitions) == 0)
                    <div class="row">
                        @foreach ($competitions as $competition)
                            <a href="/competition/{{ $competition->id }}">
                                <div class="card col-4 mb-3 border-0">
                                    <img class="card-img-top"
                                        src="{{ $competition->photo ? asset('./storage/' . $competition->photo) : asset('./assets/images/default.png') }}"
                                        alt="competition photo" style="height: 200px">
                                    <div class="competition-card">
                                        <h5 class="card-title mt-2 mb-1"><a href="/competition/{{ $competition->id }}"
                                                style="color: #000;font-size:17px">{{ $competition->name }}</a></h5>
                                        @if ($competition->is_team == 0)
                                            <a class="category" href="/?category=individuals">Individuals</a>
                                        @else
                                            <a class="category" href="/?category=teams">Teams</a>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        {{ $competitions->links() }}
                    </div>
                @else
                    <span>There is no Competition</span>
                @endunless
            </div>
        </div>
    </div>
@endsection
