@extends('backend.layouts.app')
@section('title', 'Supplier Create')
@push('after-scripts')
@endpush
@section('content')
    <x-forms.post :action="route('admin.supplier.store')" class="was-validated" id="myForm" enctype="multipart/form-data">

        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">
                            Supplier <small class="text-muted mode_label">Create</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-2">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.supplier.index') }}" title="Close" class="btn btn-light btn-sm"><i
                                    class="fas fa-times"></i></a>
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
                    <label for="first_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">First
                        Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" maxlength="100" id="first_name" name="first_name"
                            placeholder="Frist Name" required value="{{ old('first_name') }}" />
                        @error('first_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="last_name" class="col-sm-1 col-form-label text-lg-right text-sm-start">Last
                        Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" maxlength="100" id="last_name" name="last_name"
                            placeholder="Last Name" required value="{{ old('last_name') }}" />
                        @error('last_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="100" id="company_name" name="company_name"
                            placeholder="Company Name" required value="{{ old('company_name') }}" />
                        @error('company_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                            value="{{ old('email') }}" />
                        @error('email')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_phone" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company
                        Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="company_phone" name="company_phone" pattern="[1-9]\d+"
                            minlength="11" maxlength="15" placeholder="Company Phone"
                            value="{{ old('company_phone') }}" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('company_phone')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="phone" class="col-sm-1 col-form-label text-lg-right text-sm-start">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[1-9]\d+" minlength="11"
                            maxlength="15" placeholder="Phone" required value="{{ old('phone') }}" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('phone')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label text-lg-right text-sm-start">Address</label>
                    <textarea class="form-control col-sm-9" maxlength="100" name="address" id="address" rows="5"
                        value="{{ old('address') }}"></textarea>
                    @error('address')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            </section>

            <section class="card-footer">
                <div class=" row">
                    <div class="col-sm-6">
                        <small><span class="text-danger">Red</span> boxes are mandatory. <span
                                class="text-success">Green</span> boxes are optional.</small>
                    </div>
                    <div class="col-sm-6 text-right">
                        @can('BRAND_CREATE')
                            <button type="submit" class="btn btn-success">Save</button>
                        @endcan
                    </div>
                </div>
            </section>
            <!--card-footer-->
        </article>
        <!--card-->
    </x-forms.post>

@endsection
