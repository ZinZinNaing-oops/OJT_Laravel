<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- change browser icon -->
    <link rel="icon" href="{{ asset('img/graduation.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>System Information System</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

    <!-- data table -->
    <link href=" https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" crossorigin="anonymous">
    </script>
    <style>
        .active {
            color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #D09CFA;">
            <div class="container">
                <a class="navbar-brand {{ Request::is('/') ? 'text-white' : '' }}" href="{{ url('/') }}">
                    @lang('public.title')
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">                           
                            <a class="nav-link" href="{{ url('/students/add') }}">
                                <div class="{{ Request::is('students/add') ? 'active' : '' }}"><i class="bi bi-person-plus-fill" style="font-size: 16px;"></i>@lang('public.add_student')</div>
                            </a>                          
                        </li>
                        <li class="nav-item">                          
                            <a class="nav-link" href="{{ url('/students/update') }}">
                                <div class="{{ Request::is('students/update') || Route::currentRouteName() =='edit' ? 'active' : '' }}"><i class="bi bi-pencil-square" style="font-size: 16px;"></i>@lang('public.update_student')</div>
                            </a>                           
                        </li>
                        <li class="nav-item">                          
                            <a class="nav-link" href="{{ url('/students/view') }}">
                                <div class="{{ Request::is('students/view') ? 'active' : '' }}"><i class="bi bi-eye-fill" style="font-size: 16px;"></i>@lang('public.view_student')</div>
                            </a>                           
                        </li>
                        <li class="nav-item">                          
                            <a class="nav-link" href="{{ url('/students/delete') }}">
                                <div class="{{ Request::is('students/delete') ? 'active' : '' }}"> <i class="bi bi-person-x-fill" style="font-size: 16px;"></i>@lang('public.delete_student')</div>
                            </a>
                        </li>
                    </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            @php $locale = session()->get('locale'); @endphp
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                @switch($locale)
                                @case('en')
                                English<img src="{{ asset('img/english.png') }}" style="width: 20px;height:20px;margin-left:5px">
                                @break
                                @case('jp')
                                Japan<img src="{{ asset('img/japan.png') }}" style="width: 20px;height:20px;margin-left:5px">
                                @break
                                @default
                                English<img src="{{ asset('img/english.png') }}" style="width: 20px;height:20px;margin-left:5px">
                                @endswitch
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{  url('locale/en') }}">English<i><img src="{{ asset('img/english.png') }}" style="width: 20px;height:20px;margin-left:5px"></i></a></li>
                                <li><a class="dropdown-item" href="{{  url('locale/jp') }}">Japan<i><img src="{{ asset('img/japan.png') }}" style="width: 20px;height:20px;margin-left:5px"></i></a></li>
                            </ul>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="{{ Request::is('login') ? 'active' : '' }}">@lang('public.login')</i></a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="{{ Request::is('register') ? 'active' : '' }}">@lang('public.Register')</i></a>
                        </li>
                        @endif
                        @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('public.logout')
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>