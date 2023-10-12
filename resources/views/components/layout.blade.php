<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{asset('js/dynamicCardsColor.js')}}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{--    <title>@yield('title')</title>--}}
    <title>{{ $title ?? 'Todo Manager' }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('images/wishlist_icon.ico')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @if (auth()->id())
        <script type="module">
            window.Echo.private('App.Models.User.{{ Auth::id() }}').listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (e) => {
                toastr.success(e.user + ' subscribed to you!')
                console.log()
            })
        </script>
    @endif
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('index')}}">My wish</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wishes.index')}}">Wishes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">Users</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('users.index')}}">All users</a></li>
                            @if(!auth()->user())
                                <li><a class="dropdown-item" href="{{route('users.create')}}">Create user</a></li>
                            @endif

                        </ul>
                    </li>
                </ul>
                @if (auth()->user())
                    <a class="nav-link header-link" href="{{route('subscriptions.index')}}"> My subscriptions </a>
                    <a class="user_detail"
                       href="{{route('users.show', ['user' => auth()->user()->id])}}"> {{auth()->user()->name}}</a>
                    <a class="nav-link header-link" href="{{route('users.logout')}}" tabindex="-1">Logout</a>
                @else
                    <a class="nav-link header-link" href="{{route('users.login')}}" tabindex="-1">Login</a>
                    <a class="nav-link header-link" href="{{route('users.create')}}" tabindex="-1">Registration</a>
                @endif
                <form class="d-flex" action="{{route('search')}}" method="POST">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                           name="searchTerm" value="{{old('searchTerm')}}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <main>
        {{$slot}}
    </main>
</div>
</body>
</html>
