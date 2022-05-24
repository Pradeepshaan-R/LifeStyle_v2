@extends('backend.layouts.app')
@section('title', 'Supplier View')

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
    <x-forms.patch :action="route('admin.supplier.update', $supplier)" class="was-validated" id="myForm" enctype="multipart/form-data">
        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">
                            Supplier <small class="text-muted mode_label">View</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-4">
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
                    <label for="user_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">User Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="100" id="user_name" name="user_name"
                            readonly="readonly" required
                            @if (old('user_name')) value="{{ old('user_name') }}" @else value="{{ $supplier->user_name }}" @endif />
                        @error('user_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_name" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="100" id="company_name" name="company_name"
                            readonly="readonly" required
                            @if (old('company_name')) value="{{ old('company_name') }}" @else value="{{ $supplier->company_name }}" @endif />
                        @error('company_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Company Email" value="{{ $supplier->email }}" readonly="readonly" />
                        @error('email')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_phone" class="col-sm-2 col-form-label text-lg-right text-sm-start">Company Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15"
                            id="company_phone" name="company_phone" placeholder="Company Phone"
                            value="{{ $supplier->company_phone }}" readonly="readonly" />
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('company_phone')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="phone" class="col-sm-1 col-form-label text-lg-right text-sm-start">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" pattern="[1-9]\d+" minlength="11" maxlength="15"
                            id="phone" name="phone" placeholder="Company Phone"
                            value="{{ $supplier->phone }}" readonly="readonly" />
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
                        value="{{ $supplier->address }}"
                        readonly="readonly">{{ $supplier->address }}</textarea>
                    @error('address')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            </section>

            <section class="card-footer">
                <div class="row">
                    <div class="col">
                        @can('BRAND_DELETE')
                            <button type="button" url="{{ route('admin.supplier.destroy', $supplier->id) }}"
                                return_url="{{ route('admin.supplier.index') }}"
                                class="btn btn-danger btn_delete">Delete</button>
                        @endcan
                    </div>
                    <div class="col text-right">
                        @can('BRAND_EDIT')
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
