@extends('backend.layouts.app')
@section('title', 'Category view')

@push('after-scripts')
@include('backend.includes.azmeer.btn_delete')

<script>
    //multi function edit/update button with input:readyonly control
        $(function() {
            var isEditable = false;
            $('.btn_edit').on('click', function() {
                isEditable = true;
                $('.btn_edit').hide();
                $('.btn_update').show();
                $('.mode_label').text('Update');
                $('form input, form select, form textarea, form select option').each(
                    function(index) {
                        $(this).removeAttr('readonly');
                        $(this).removeAttr('disabled');
                    }
                );
            });
        });
</script>
@endpush

@section('content')
<x-forms.patch :action="route('admin.user_extra.update', $userExtra)" class="was-validated" id="myForm"
    enctype="multipart/form-data">
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">
                        User Extra <small class="text-muted mode_label">View</small>
                    </h4>
                </div>
                <!--col-->
                <div class="col-4">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.user_extra.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                <label for="role" class="col-md-2 col-form-label text-lg-right text-sm-start">Role</label>

                <div class="col-md-10">
                    <select class="form-control" name="role" required readonly="readonly">
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @if($user->role == $role->name) selected @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Name')</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="User name"
                        maxlength="100" value="{{ $user->name }}" readonly="readonly" />
                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Title')</label>
                <input type="hidden" name="id" value="{{ $userExtra->id }}">

                <div class="col-sm-10">
                    <select class="form-control" name='title' id="title" readonly="readonly">
                        @foreach (App\Models\UserExtra::getEnum('title') as $title)
                        <option value="{{ $title }}" {{ $userExtra->title == $title ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                        @endforeach
                    </select>
                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password"
                    class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('password')</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="password" class="form-control" readonly="readonly"
                        placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password"
                        value="{{ $user->password }}" />
                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Phone')</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('phone') }}"
                        maxlength="100" value="{{ $userExtra->phone }}" readonly="readonly" />
                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nic" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('NIC')</label>
                <div class="col-sm-10">
                    <input type="text" name="nic" id="nic" class="form-control" placeholder="{{ __('nic') }}"
                        maxlength="100" value="{{ $userExtra->nic }}" readonly="readonly" />
                    @error('nic') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="designation"
                    class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Designation')</label>
                <div class="col-sm-10">
                    <input type="text" name="designation" id="designation" class="form-control"
                        placeholder="{{ __('nic') }}" maxlength="100" value="{{ $userExtra->designation }}"
                        readonly="readonly" />
                    @error('designation') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address"
                    class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('Address')</label>
                <div class="col-sm-10">
                    <input type="text" name="address" id="address" class="form-control"
                        placeholder="{{ __('address') }}" maxlength="100" value="{{ $userExtra->address }}"
                        readonly="readonly" />
                    @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-2 col-form-label text-lg-right text-sm-start">@lang('City')</label>
                <div class="col-sm-10">
                    <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('city') }}"
                        maxlength="100" value="{{ $userExtra->city }}" readonly="readonly" />
                    @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
        </section>
        <!--card-body-->
        <input type="hidden" name="user_id" value="{{$userExtra->user_id}}" />
        <section class="card-footer">
            <div class="row">
                <div class="col">
                    @can('USEREXTRA_DELETE')
                    <button type="button" url="{{ route('admin.user_extra.destroy', $userExtra->id) }}"
                        return_url="{{ route('admin.user_extra.index')}}" class="btn btn-danger btn_delete">Delete</button>
                    @endcan
                </div>
                <div class="col text-right">
                    @can('USEREXTRA_EDIT')
                    <button type="submit" class="btn btn-success btn_update" style="display: none;">Update</button>
                    <button type="button" class="btn btn-primary btn_edit">Edit</button>
                    @endcan
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
    <!--card-->
    </x-forms.post>


    @endsection