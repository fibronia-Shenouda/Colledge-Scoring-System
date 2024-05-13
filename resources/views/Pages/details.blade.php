@extends('Pages/layout')

@section('title')
    Details
@endsection

@section('content')
    @php
        $hasIndividualEvents = false;
        $count = 0;
        $url = '';
    @endphp
    <div class="container-fluid">
        @if (session('error'))
            <div class="alert alert-danger mt-3" id="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row mt-2">
            <p class="cop-details-name mt-2">{{ $competition->name }}</p>
            <div class="line"></div>
        </div>
        <div class="row" style="padding-left: 3%; padding-right: 3%; padding-top: 1%">
            <div class="col-5 cop-details-img-field">
                <img class="card-img-top cop-details-img"
                    src="{{ $competition->photo ? asset('./storage/' . $competition->photo) : asset('./assets/images/default.png') }}"
                    alt="competition photo">
            </div>
            <div class="col-7">
                <div class="cop-details-desc-field">
                    <p class="cop-details-title">{{ $competition->name }}</p>
                    <p class="cop-details-details">{{ $competition->description }}</p> {{-- 150 word --}}
                    @auth
                        @if (auth()->user()->priviledge == 'admin')
                            <a href="/update/competition/{{ $competition->id }}">
                                <button class="btn btn-success">Edit Competition</button>
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <p class="cop-details-name">Events</p>
            </div>
            <div class="col d-flex justify-content-end">
                @auth
                    @if (auth()->user()->priviledge == 'student')
                        <p>Joined Events:
                        <p id="count">0</p>
                        </p>
                    @endif
                @endauth
            </div>
            <div class="line"></div>
        </div>
        <div class="row comp-details-events" style="padding-left: 3%; padding-right: 3%">
            <div id="accordion"class="container-fluid mt-3 accordion-container">
                @unless (count($competition->events) == 0)
                    @foreach ($competition->events as $event)
                        <div class="card mb-2">
                            <div class="card-header" id="heading{{ $event->id }}" data-toggle="collapse"
                                data-target="#collapse{{ $event->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $event->id }}">
                                <h5 class="accord-title mb-0 btn">
                                    {{ $event->name }}
                                </h5>
                            </div>

                            <div id="collapse{{ $event->id }}" class="collapse"
                                aria-labelledby="heading{{ $event->id }}" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="acc-event-desc">
                                        <p>{{ $event->description }}</p>
                                    </div>
                                    <div class="e-category">
                                        @if ($event->is_academic == 1)
                                            <p class="mt-2">Academic</p>
                                        @else
                                            <p class="mt-2">Sport</p>
                                        @endif
                                        @auth
                                            @if (auth()->user()->priviledge == 'student')
                                                <button id="{{ $event->id }}" class="btn-add"
                                                    data-product="{{ $event->name }}"><i class="bi bi-plus-circle"></i></button>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">
                        @if ($competition->is_team == 0)
                            @php
                                $url = 'individual';
                            @endphp
                        @else
                            @php
                                $url = 'team';
                            @endphp
                        @endif
                        <form action="/competition/login/{{ $url }}">
                            @csrf
                            <input type="hidden" id="counterValue" name="counterValue">
                            <input type="hidden" id="events" name="events">
                            @auth
                                @if (auth()->user()->priviledge == 'student')
                                    <button id="join" type="submit" class="search-btn w-25" type="submit">Join
                                        Competition</button>
                                @endif
                            @endauth
                        </form>
                    </div>
                @else
                    <p><i class="bi bi-clock-history"></i> There is no events in this competition yet.</p>
                @endunless

            </div>
        </div>
    </div>
    <script src="{{ asset('./main.js') }}"></script>
@endsection
