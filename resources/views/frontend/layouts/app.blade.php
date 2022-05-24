<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="ShareColombo - Azmeer">
    @yield('meta')

    @stack('before-styles')
    {{-- Roof cal wizard --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset(mix('css/frontend.css')) }}" rel="stylesheet">
    <livewire:styles />

    @stack('after-styles')
</head>

<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    {{-- @include('includes.partials.announcements') --}}

    <div id="app">
        {{-- @include('frontend.includes.nav') --}}
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


    @stack('after-scripts')
</body>

</html>