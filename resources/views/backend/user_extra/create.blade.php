@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create User'))

@section('content')
<x-forms.post :action="route('admin.user_extra.store')" class="was-validated" id="myForm">
    <x-backend.card>
        <x-slot name="header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        User <small class="text-muted mode_label">Create</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-2">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.user_extra.index') }}" title="Close" class="btn btn-light btn-sm"><i
                                class="fas fa-times"></i></a>
                    </div>
                    <!--btn-toolbar-->
                </div>
                <!--col-->
            </div>
        </x-slot>

        <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-lg-right text-sm-start">Role</label>

                    <div class="col-md-10">
                        <select class="form-control" name="role" required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title"
                        class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Title')</label>

                    <div class="col-sm-10">
                        <select class="form-control" name='title' id="title">
                            @foreach( App\Models\UserExtra::getEnum('title') as $title)
                            <option value="{{ $title }}" {{ old('title')==$title ? 'selected' :''}}>{{ $title }}
                            </option>
                            @endforeach
                        </select>
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-lg-right text-sm-start">Name</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                            value="{{ old('name') }}" maxlength="100" required />
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('E-mail
                        Address')</label>

                    <div class="col-md-10">
                        <input type="email" name="email" class="form-control" placeholder="{{ __('E-mail Address') }}"
                            value="{{ old('email') }}" maxlength="255" required />
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    <label for="password"
                        class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Password')</label>

                    <div class="col-md-10">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    <label for="password_confirmation"
                        class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Password
                        Confirmation')</label>

                    <div class="col-md-10">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100"
                            required autocomplete="new-password" />
                    </div>
                </div>
                <!--form-group-->



                <div class="form-group row">
                    <label for="phone"
                        class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Phone')</label>

                    <div class="col">
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Phone Number of the user" value="{{old('phone')}}" />
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="nic" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('NIC')</label>

                    <div class="col">
                        <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC of the user"
                            value="{{old('nic')}}" />
                        @error('nic') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </div>


                <div class="form-group row">
                    <label for="designation"
                        class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Designation')</label>

                    <div class="col">
                        <input type="text" class="form-control" id="designation" name="designation"
                            placeholder="Designation of the user" value="{{old('designation')}}" />
                        @error('designation') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="address"
                        class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Address')</label>

                    <div class="col">
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Address of the user" value="{{old('address')}}" />
                        @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="city" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('City')</label>

                    <div class="col">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City of the user"
                            value="{{old('city')}}" />
                        @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </div>

        </x-slot>

        <x-slot name="footer">
            <div class=" row">
                <div class="col-sm-6">
                    <small><span class="text-danger">Red</span> boxes are mandatory. <span
                            class="text-success">Green</span> boxes are optional.</small>
                </div>
                <div class="col-sm-6 text-right">
                    @can('USEREXTRA_CREATE')
                    <button type="submit" class="btn btn-success">Save</button>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-backend.card>
</x-forms.post>
@endsection
