@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<x-backend.card>
    <x-slot name="header">
        @lang('Welcome :Name', ['name' => $logged_in_user->name])
    </x-slot>

    <x-slot name="body">
        @include('backend.dashboard.infobox1')
    </x-slot>
</x-backend.card>

<x-backend.card>
    <x-slot name="body">
        @include('backend.dashboard.infobox2')
    </x-slot>
</x-backend.card>

{{-- <x-backend.card>
    <x-slot name="header">
        @lang('Welcome :Name', ['name' => $logged_in_user->name]) - info box 3
    </x-slot>

    <x-slot name="body">
        @include('backend.dashboard.infobox3')
    </x-slot>
</x-backend.card>

<x-backend.card>
    <x-slot name="header">
        @lang('Welcome :Name', ['name' => $logged_in_user->name]) - info box 4
    </x-slot>

    <x-slot name="body">
        @include('backend.dashboard.infobox4')
    </x-slot>
</x-backend.card>

<x-backend.card>
    <x-slot name="header">
        @lang('Welcome :Name', ['name' => $logged_in_user->name]) - chart 1
    </x-slot>

    <x-slot name="body">
        <section class="row">
            <aside class="col-lg-6">
                @include('backend.dashboard.chart1')
            </aside>

            <aside class="col-lg-6">
                @include('backend.dashboard.chart2')
            </aside>
        </section>
    </x-slot>
</x-backend.card> --}}

@endsection