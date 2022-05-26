@extends('backend.layouts.app')
@section('title', 'Stock Create')
@push('after-scripts')
@endpush
@section('content')
    <x-forms.post :action="route('admin.stock.store')" class="was-validated" id="myForm" enctype="multipart/form-data">

        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">
                            Stock <small class="text-muted mode_label">Create</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-2">
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
                    <label for="product_id" class="col-sm-2 col-form-label text-lg-right text-sm-start">Product</label>

                    <div class="col-sm-4">
                        <select class="form-control" name='product_id' id="product_id" required>
                            <option value="">--Product--</option>
                            @foreach (App\Models\Product::get() as $value)
                                <option value="{{ $value->id }}" {{ old('product_id') == $value->id ? 'selected' : '' }}>
                                    {{ $value->title }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="supplier_id" class="col-sm-1 col-form-label text-lg-right text-sm-start">Supplier</label>

                    <div class="col-sm-4">
                        <select class="form-control" name='supplier_id' id="supplier_id" required>
                            <option value="">--Supplier--</option>
                            @foreach (App\Models\Supplier::get() as $value)
                                <option value="{{ $value->id }}" {{ old('supplier_id') == $value->id ? 'selected' : '' }}>
                                    {{ $value->user_name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="registration_date" class="col-sm-2 col-form-label text-lg-right text-sm-start">Registration Date</label>

                    <div class="col-sm-4">
                        <input type="date" required class="form-control" min="{{ date('Y-m-d') }}" id="registration_date"
                            name="registration_date" placeholder="Registration Date" value="{{ old('registration_date') }}" />
                        @error('registration_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="expiry_date" class="col-sm-1 px-0 col-form-label text-lg-right text-sm-start">Expiry Date</label>

                    <div class="col-sm-4">
                        <input type="date" required class="form-control" min="{{ date('Y-m-d') }}" id="expiry_date"
                            name="expiry_date" placeholder="Expiry Date" value="{{ old('expiry_date') }}" />
                        @error('expiry_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ml-1">
                    <label for="description" class="col-sm-2 col-form-label text-lg-right text-sm-start">Description</label>

                    <textarea class="form-control col-sm-9" maxlength="250" name="description" id="description"
                        rows="5" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label text-lg-right">Quantity</label>

                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Product Quantity"
                            value="{{ old('quantity') }}" required />
                        @error('quantity')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
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
