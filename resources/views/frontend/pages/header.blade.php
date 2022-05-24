<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ appName() }}</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="ShareColombo - Azmeer">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ asset(mix('css/frontend.css')) }}" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@webpixels/css@^1.0/dist/index.css">

    @include('frontend.pages.styles')
    <livewire:styles />
    @stack('after-styles')
</head>

<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    @include('includes.partials.announcements')

    <div id="app" class="flex-center position-ref full-height">
        <nav class="navbar navbar-expand-lg navbar-light px-0 py-3">
            <div class="container-xl max-w-screen-xl">
                <!-- Logo -->
                <h3><a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('/img/brand/logo_min.png')}}" alt="Logo" class="m-2"> {{config('app.name')}}
                    </a></h3>
                <!-- Navbar toggle -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Nav -->
                    <ul class="navbar-nav mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/pages/features')}}">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                    </ul>
                    <!-- Right navigation -->
                    @auth
                    @if ($logged_in_user->isUser())
                    <a class="btn btn-sm btn-neutral w-full w-lg-auto"
                        href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a> &nbsp;
                    @endif

                    <a class="btn btn-sm btn-neutral w-full w-lg-auto"
                        href="{{ route('frontend.user.account') }}">@lang('Account')</a>
                    @else
                    <div class="navbar-nav ms-lg-4">
                        <a class="btn btn-sm btn-neutral w-full w-lg-auto"
                            href="{{ route('frontend.auth.login') }}">@lang('Login')</a>
                    </div>
                    @if (config('boilerplate.access.user.registration'))
                    <div class="d-flex align-items-lg-center mt-3 mt-lg-0">
                        <a class="nav-item nav-link" href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                    </div>
                    @endif
                    @endauth
                    <!-- Action -->
                </div>
            </div>
        </nav>
