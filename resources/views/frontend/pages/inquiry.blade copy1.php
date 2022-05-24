@extends('frontend.layouts.app')
@section('title', __('Inquiry'))


@push('after-scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
    {{-- Roof Wizard --}}
    {{-- <script src="{{ asset('wizard\js\jquery-3.3.1.min.js') }}"></script> --}}
    <script src="{{ asset('wizard\js\jquery.steps.js') }}"></script>
    <script src="{{ asset('wizard\js\jquery-ui.min.js') }}"></script>
    <script src="{{ asset('wizard\js\main.js') }}"></script>

@endpush


@section('content')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('wizard\fonts\material-design-iconic-font\css\material-design-iconic-font.min.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" type="text/css" href="{{ asset('wizard\css\jquery-ui.min.css') }}">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('wizard\css\style.css') }}" />

    <div class="page-content" style="background-image: url('images/wizard-v3.jpg_')">


    <livewire:inquiry-create/>

    </div>


    <!-- Modal -->
    <article class="modal fade" id="productViewModal" tabindex="-1" aria-labelledby="productViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Photo and description here
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </article>

@endsection
