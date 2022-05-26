@extends('backend.layouts.app')
@section('title', 'Stock View')

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
    <x-forms.patch :action="route('admin.stock.update', $stock)" class="was-validated" id="myForm" enctype="multipart/form-data">
        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">
                            Stock <small class="text-muted mode_label">View</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-4">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.stock.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                    <label for="product_id" class="col-sm-2 px-0 col-form-label text-lg-right text-sm-start">Product</label>
                    <div class="col-sm-4">
                        <select class="form-control" name='product_id' id="product_id" readonly="readonly" disabled>
                            <option value="">--Product--</option>
                            @foreach (App\Models\Product::get() as $one)
                                <option value="{{ $one->id }}"
                                    {{ $stock->product_id == $one->id ? 'selected' : '' }}>
                                    {{ $one->title }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="supplier_id"
                        class="col-sm-1 px-0 col-form-label text-lg-right text-sm-start">Supplier</label>
                    <div class="col-sm-4">
                        <select class="form-control" name='supplier_id' id="supplier_id" readonly="readonly" disabled>
                            <option value="">--Supplier--</option>
                            @foreach (App\Models\Supplier::get() as $one)
                                <option value="{{ $one->id }}"
                                    {{ $stock->supplier_id == $one->id ? 'selected' : '' }}>
                                    {{ $one->user_name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="registration_date" class="col-sm-2 col-form-label text-lg-right text-sm-start">Registration
                        Date</label>

                    <div class="col-sm-4">
                        <input type="date" class="form-control date" name="registration_date" id="registration_date"
                            placeholder="Date/Time" value="{{ date('Y-m-d', strtotime($stock->registration_date)) }}"
                            readonly="readonly">
                        @error('registration_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="expiry_date" class="col-sm-1 col-form-label text-lg-right text-sm-start">Expiry Date</label>

                    <div class="col-sm-4">
                        <input type="date" class="form-control date" name="expiry_date" id="expiry_date"
                            placeholder="Date/Time" value="{{ date('Y-m-d', strtotime($stock->expiry_date)) }}"
                            readonly="readonly">
                        @error('expiry_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label text-lg-right text-sm-start">Description</label>

                    <textarea class="form-control col-sm-9" maxlength="200" name="description" id="description" rows="5"
                        value="{{ $stock->description }}" placeholder="{{ $stock->description }}"
                        readonly="readonly">{{ $stock->description }}</textarea>
                    @error('description')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            </section>
            <!--card-body-->
            <section class="card-footer">
                <div class="row">
                    <div class="col">
                        @can('BRAND_DELETE')
                            <button type="button" url="{{ route('admin.stock.destroy', $stock->id) }}"
                                return_url="{{ route('admin.stock.index') }}"
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
