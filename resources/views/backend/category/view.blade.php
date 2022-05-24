@extends('backend.layouts.app')
@section('title', 'Category View')

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
    <x-forms.patch :action="route('admin.category.update', $category)" class="was-validated" id="myForm" enctype="multipart/form-data">
        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">
                            Category <small class="text-muted mode_label">View</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-4">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.category.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                    <label for="title" class="col-sm-2 col-form-label text-lg-right">Title</label>
                    <div class="col">
                        <input type="text" class="form-control" id="title" name="title" readonly="readonly" required
                            @if (old('title')) value="{{ old('title') }}" @else value="{{ $category->title }}" @endif />
                        @error('title')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row py-0">
                    <label for="status" class="col-sm-2 col-form-label text-lg-right text-sm-start">Status</label>
                    <div class="col-sm-3">
                        <select class="form-control" name='status' id="status" readonly="readonly">
                            <option value="">--Status--</option>
                            @foreach (App\Models\Category::getEnum('Status') as $value)
                                <option value="{{ $value }}" {{ $category->status == $value ? 'selected' : '' }}>
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
                    <label for="document" class="col-sm-2 col-form-label text-lg-right text-sm-start">Category Image</label>

                    <div class="col-sm-3">
                        <input type="file" class="col-sm-9" id="document" name="document"
                            placeholder="Support document" value="{{ old('document') }}" />
                        @error('document')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($category->filename)
                        <label for="document" class="col-sm-3 col-form-label text-lg-right text-sm-start">Image</label>
                        <div class="col-sm-3 pt-1">
                            <button type="button" class="btn btn-dark">
                                <a target="_blank" class="text-white text-decoration-none"
                                    href="{{ asset('storage/uploads/') . '/' . $category->filename }}">View
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
                            <button type="button" url="{{ route('admin.category.destroy', $category->id) }}"
                                return_url="{{ route('admin.category.index') }}"
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
