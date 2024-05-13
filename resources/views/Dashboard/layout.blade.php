<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('./style/pagesStyle.css') }}" rel="stylesheet">
    <link href="{{ asset('./style/dashboard.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('./assets/images/logo.png') }}" type="image/png">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="padding: 0px;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="logo"><img class="nav-logo" src="{{ asset('./assets/images/logo.png') }}" alt="">
                    <p> UNIVERSITY</p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Unsigned user --}}
                @auth
                @php
                        $userName = ucfirst(auth()->user()->name);
                    @endphp
                    @if (auth()->user()->priviledge == 'student')
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <button class="login-btn"><a class="nav-link" style="color: #194185"
                                            href="/profile/{{ auth()->user()->id }}"><i class="bi bi-person-fill"></i>
                                            Welcom,
                                            {{ $userName }}</a></button>
                                </li>
                                <li class="nav-item">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="sign-btn"><a class="nav-link" style="color: white"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a></button>
                                    </form>
                                </li>
                            </ul>
                        @elseif(auth()->user()->priviledge === 'admin')
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <button class="login-btn"><a class="nav-link" style="color: #194185"
                                                href="/profile/{{ auth()->user()->id }}"><i class="bi bi-person-fill"></i>
                                                Welcom,
                                                {{ $userName }}</a></button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="sign-btn">
                                            <a class="nav-link" style="color:white" href="/competitions/dashboard"><i
                                                    class="bi bi-gear-fill"></i> manage</a>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <form action="/logout" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="sign-btn"><a class="nav-link"
                                                    style="color: white"><i class="bi bi-box-arrow-right"></i>
                                                    Logout</a></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <button class="login-btn">
                                        <a class="nav-link" style="color: #194185;" href="/login"><i
                                                class="bi bi-box-arrow-in-right"></i> Sign
                                            In</a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="sign-btn">
                                        <a class="nav-link" style="color:white" href="/login/student"><i
                                                class="bi bi-person-plus-fill"></i>
                                            Sign Up</a>
                                    </button>
                                </li>
                            </ul>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row side">
            <div class="side-nav">
                @auth
                    @if (auth()->user()->priviledge == 'admin')
                        <a href="/competitions/dashboard">
                            <button class="row btn"><i class="bi bi-bookmark-fill"></i> Competitions</button>
                        </a>
                        <a href="/add/competition">
                            <button class="row btn"><i class="bi bi-plus-circle-fill"></i> Add
                                Competition</button>
                        </a>
                        <a href="/add/scores">
                            <button class="row btn"><i class="bi bi-trophy-fill"></i> Add
                                Score</button>
                        </a>
                        <a href="/results">
                            <button class="row btn"><i class="bi bi-graph-up-arrow"></i>
                                Results</button>
                        </a>
                        <a href="/individuals">
                            <button class="row btn"><i class="bi bi-people-fill"></i>
                                Individuals</button>
                        </a>
                        <a href="/teams">
                            <button class="row btn"><i class="bi bi-file-person-fill"></i>
                                Teams</button>
                        </a>
                        <a href="/students">
                            <button class="row btn"><i class="bi bi-people-fill"></i>
                                Students</button>
                        </a>
                    @else
                        <a href="/competitions/dashboard">
                            <button class="row btn"><i class="bi bi-bookmark-fill"></i> Competitions</button>
                        </a>
                        <a href="/add/competition">
                            <button class="row btn"><i class="bi bi-plus-circle-fill"></i> Add
                                Competition</button>
                        </a>
                        <a href="/add/scores">
                            <button class="row btn"><i class="bi bi-trophy-fill"></i> Add
                                Score</button>
                        </a>
                        <a href="/results">
                            <button class="row btn"><i class="bi bi-graph-up-arrow"></i>
                                Results</button>
                        </a>
                        <a href="/individuals">
                            <button class="row btn"><i class="bi bi-people-fill"></i>
                                Individuals</button>
                        </a>
                        <a href="/teams">
                            <button class="row btn"><i class="bi bi-file-person-fill"></i>
                                Teams</button>
                        </a>
                        <a href="/students">
                            <button class="row btn"><i class="bi bi-people-fill"></i>
                                Students</button>
                        </a>
                        <a href="/add/admins">
                            <button class="row btn"><i class="bi bi-person-fill-add"></i> Add
                                Admin</button>
                        </a>
                        <a href="/admins">
                            <button class="row btn" style="border: none"><i class="bi bi-people-fill"></i>
                                Admins</button>
                        </a>
                    @endif
                @endauth
            </div>
            <div class="center">@yield('content')</div>
        </div>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap JS (optional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        setTimeout(function() {
            document.getElementById('message').style.display = 'none';
        }, 2800);
    </script>
</body>

</html>
