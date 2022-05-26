@extends('backend.layouts.app')
@section('title', 'Customer View')

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
    <x-forms.patch :action="route('admin.customer.update', $customer)" class="was-validated" id="myForm" enctype="multipart/form-data">
        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">
                            Customer <small class="text-muted mode_label">View</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-4">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.customer.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                    <label for="first_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="100" id="first_name" name="first_name"
                            readonly="readonly" required
                            @if (old('first_name')) value="{{ old('first_name') }}" @else value="{{ $customer->first_name }}" @endif />
                        @error('first_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="100" id="last_name" name="last_name"
                            readonly="readonly" required
                            @if (old('last_name')) value="{{ old('last_name') }}" @else value="{{ $customer->last_name }}" @endif />
                        @error('last_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ $customer->email }}" readonly="readonly" />
                        @error('email')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label text-lg-right text-sm-start">Phone</label>
                    <div class="col-sm-3">
                        <input type="tel" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15" id="phone"
                            name="phone" placeholder="Phone" value="{{ $customer->phone }}" readonly="readonly" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('phone')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="dob" class="col-sm-2 col-form-label text-lg-right text-sm-start">Date Of Birth</label>

                    <div class="col-sm-3">
                        <input type="date" class="form-control date" name="dob" id="dob"
                            placeholder="Date/Time" value="{{ date('Y-m-d', strtotime($customer->dob)) }}"
                            readonly="readonly">
                        @error('dob')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="card-footer">
                <div class="row">
                    <div class="col">
                        @can('BRAND_DELETE')
                            <button type="button" url="{{ route('admin.customer.destroy', $customer->id) }}"
                                return_url="{{ route('admin.customer.index') }}"
                                class="btn btn-danger btn_delete">Delete</button>
                        @endcan
                    </div>
                    {{-- <div class="col text-right">
                        @can('BRAND_EDIT')
                            <button type="submit" class="btn btn-success btn_update" style="display: none;">Update</button>
                            <button type="button" class="btn btn-primary btn_edit">Edit</button>
                        @endcan
                    </div> --}}
                </div>
            </section>
            <!--card-footer-->
        </article>
        <!--card-->

        </x-forms.post>

    @endsection
