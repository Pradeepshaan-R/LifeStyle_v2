<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
       {{-- Roof cal wizard --}}
       <link rel="stylesheet" type="text/css" href="{{ asset('wizard\css\roboto-font.css') }}">
       <link rel="stylesheet" type="text/css"
           href="{{ asset('wizard\fonts\material-design-iconic-font\css\material-design-iconic-font.min.css') }}">
       <!-- datepicker -->
       <link rel="stylesheet" type="text/css" href="{{ asset('wizard\css\jquery-ui.min.css') }}">
       <!-- Main Style Css -->
       <link rel="stylesheet" href="{{ asset('wizard\css\style.css') }}" />
           {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}

       {{-- Roof cal wizard --}}



    @stack('after-styles')
</head>

<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    {{-- @include('includes.partials.announcements') --}}

    <div id="app">
        @include('frontend.includes.nav')
        @include('includes.partials.messages')

        <main>
            @yield('content')
        </main>
    </div>
    <!--app-->

    @stack('before-scripts')
    <script src="{{ asset(mix('js/manifest.js')) }}"></script>
    <script src="{{ asset(mix('js/vendor.js')) }}"></script>
    <script src="{{ asset(mix('js/frontend.js')) }}"></script>
    <livewire:scripts />
    {{-- Roof Wizard --}}
    <script src="{{ asset('wizard\js\jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('wizard\js\jquery.steps.js') }}"></script>
    <script src="{{ asset('wizard\js\jquery-ui.min.js') }}"></script>
    <script src="{{ asset('wizard\js\main.js') }}"></script>

    @stack('after-scripts')
</body>

</html>
