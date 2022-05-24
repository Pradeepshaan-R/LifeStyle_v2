@extends('backend.layouts.app')
@section('title', 'Book create')
@section('content')

<x-forms.post :action="route('admin.user_extra.user_settings_set')" class="was-validated" id="myForm"
    enctype="multipart/form-data">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        User <small class="text-muted mode_label">Settings</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-2">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.user_extra.user_settings_get') }}" title="Close"
                            class="btn btn-light btn-sm"><i class="fas fa-times"></i></a>
                    </div>
                    <!--btn-toolbar-->
                </div>
                <!--col-->
            </div>
            <!--card-header-actions-->
        </section>
        <!--card-header-->

        <section class="card-body">

            <div class="form-group row">
                @foreach( App\Models\UserExtra::get_current() as $key => $value)
                <div class="col-sm-10 offset-sm-1 custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="{{ $key }}" {{ $value ? 'checked':''}}>
                    <label class="custom-control-label" for="{{ $key }}">{{ $key }}</label>
                </div>
                @endforeach
            </div>

        </section>
        <!--card-body-->

        <section class="card-footer">
            <div class=" row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-right">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
    <!--card-->
</x-forms.post>

@endsection