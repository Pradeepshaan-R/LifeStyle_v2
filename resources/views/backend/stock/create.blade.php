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
                    <label for="category_id" class="col-sm-2 col-form-label text-lg-right text-sm-start">Category</label>

                    <div class="col-sm-4">
                        <select class="form-control" name='category_id' id="category_id" required>
                            <option value="">--Category--</option>
                            @foreach (App\Models\Category::get() as $value)
                                <option value="{{ $value->id }}" {{ old('type') == $value->id ? 'selected' : '' }}>
                                    {{ $value->title }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label text-lg-right">Title</label>

                    <div class="col-sm-6 pr-0">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title of the Product"
                            value="{{ old('title') }}" required />
                        @error('title')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label text-lg-right">Price</label>

                    <div class="col-sm-6 pr-0">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price of the Product"
                            value="{{ old('price') }}" required />
                        @error('price')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ml-1">
                    <label for="description" class="col-sm-2 col-form-label text-lg-right text-sm-start">Description</label>

                    <textarea class="form-control col-sm-6" maxlength="250" name="description" id="description"
                        rows="5" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="document" class="col-sm-2 col-form-label text-lg-right text-sm-start">Product Image</label>

                    <div class="col-sm-3">
                        <input type="file" class="col-sm-9" id="document" name="document"
                            placeholder="Support document" value="{{ old('document') }}" />
                        @error('document')
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
