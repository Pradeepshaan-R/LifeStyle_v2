@extends('backend.layouts.app')
@section('title', 'Product View')

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
    <x-forms.patch :action="route('admin.product.update', $product)" class="was-validated" id="myForm" enctype="multipart/form-data">
        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">
                            Product <small class="text-muted mode_label">View</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-4">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.product.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                    <label for="category_id"
                        class="col-sm-2 px-0 col-form-label text-lg-right text-sm-start">Category</label>
                    <div class="col-sm-4">
                        <select class="form-control" name='category_id' id="category_id" readonly="readonly" disabled>
                            <option value="">--Category Number--</option>
                            @foreach (App\Models\Category::get() as $one)
                                <option value="{{ $one->id }}"
                                    {{ $product->category_id == $one->id ? 'selected' : '' }}>
                                    {{ $one->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="title" class="col-sm-1 col-form-label text-lg-right">Title</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="title" name="title" readonly="readonly" required
                            @if (old('title')) value="{{ old('title') }}" @else value="{{ $product->title }}" @endif />
                        @error('title')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row py-0">
                    <label for="price" class="col-sm-2 col-form-label text-lg-right text-sm-start">Price</label>

                    <div class="col-sm-4">
                        <input type="text" maxlength="9" pattern="\d*" min="0" class="form-control" id="price"
                            name="price" readonly="readonly" required
                            @if (old('price')) value="{{ old('price') }}" @else value="{{ $product->price }}" @endif />
                        @error('price')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="status" class="col-sm-1 col-form-label text-lg-right text-sm-start">Status</label>
                    <div class="col-sm-4">
                        <select class="form-control" name='status' id="status" readonly="readonly">
                            <option value="">--Status--</option>
                            @foreach (App\Models\Product::getEnum('Status') as $value)
                                <option value="{{ $value }}" {{ $product->status == $value ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label text-lg-right text-sm-start">Description</label>

                    <textarea class="form-control col-sm-9" maxlength="200" name="description" id="description" rows="5"
                        value="{{ $product->description }}" placeholder="{{ $product->description }}"
                        readonly="readonly">{{ $product->description }}</textarea>
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

                    @if ($product->filename)
                        <label for="document" class="col-sm-2 col-form-label text-lg-right text-sm-start">Image</label>
                        <div class="col-sm-3 pt-1">
                            <button type="button" class="btn btn-dark">
                                <a target="_blank" class="text-white text-decoration-none"
                                    href="{{ asset('storage/uploads/') . '/' . $product->filename }}">View
                                    Image</a>
                            </button>
                        </div>
                    @endif
                </div>

            </section>
            <!--card-body-->
            <section class="card-footer">
                <div class="row">
                    <div class="col">
                        @can('BRAND_DELETE')
                            <button type="button" url="{{ route('admin.product.destroy', $product->id) }}"
                                return_url="{{ route('admin.product.index') }}"
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
