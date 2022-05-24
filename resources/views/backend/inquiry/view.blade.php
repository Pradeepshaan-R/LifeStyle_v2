@extends('backend.layouts.app')
@section('title', 'inquiry view')

@push('after-scripts')
    @include('backend.includes.azmeer.btn_delete')
    <script>
        const photo = document.querySelector("#photo");
        photo.addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                const uploaded_image = reader.result;
                document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        });
    </script>
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
    <style>
        #display_image {
            margin-top: 5px;
            width: 200px;
            height: 150px;
            border: 1px solid #a7a7a7;
            background-position: center;
            background-size: cover;
        }

    </style>
@endpush

@section('content')
    <x-forms.patch :action="route('admin.inquiry.update',$inquiry)" class="was-validated" id="myForm"
        enctype="multipart/form-data">
        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">
                            Inquiry <small class="text-muted mode_label">View</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-4">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.inquiry.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                    <label for="name" class="col-sm-2 col-form-label text-lg-right">Customer Name</label>
                    <div class="col">
                        <input type="text" class="form-control" id="title" name="name" readonly="readonly" required
                            @if (old('name')) value="{{ old('name') }}" @else value="{{ $inquiry->name }}" @endif />
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label text-lg-right">Contact Number</label>
                    <div class="col">
                        <input type="text" class="form-control" id="phone" name="phone" readonly="readonly" required
                            @if (old('phone')) value="{{ old('phone') }}" @else value="{{ $inquiry->phone }}" @endif />
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roof_area" class="col-sm-2 col-form-label text-lg-right">Roofing Area</label>
                    <div class="col">
                        <input type="text" class="form-control" id="roof_area" name="roof_area" readonly="readonly"
                            required @if (old('roof_area')) value="{{ old('roof_area') }}" @else value="{{ $inquiry->roof_area }}" @endif />
                        @error('roof_area') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roof_unit" class="col-sm-2 col-form-label text-lg-right">Roofing Unit</label>
                    <div class="col">

                        <select class="form-control select2" name='roof_unit' id="roof_unit" readonly="readonly" required>

                            <option {{ $inquiry->roof_unit == 'sqft' ? 'selected' : '' }} value="sqft">
                                sq.Footer</option>
                            <option {{ $inquiry->roof_unit == 'sqm' ? 'selected' : '' }} value="sqm">
                                sq.Meters </option>
                        </select>
                        @error('roof_unit') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ceiling_area" class="col-sm-2 col-form-label text-lg-right">Ceiling Area</label>
                    <div class="col">
                        <input type="text" class="form-control" id="ceiling_area" name="ceiling_area" readonly="readonly"
                            required @if (old('ceiling_area')) value="{{ old('ceiling_area') }}" @else value="{{ $inquiry->ceiling_area }}" @endif />
                        @error('ceiling_area') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ceiling_unit" class="col-sm-2 col-form-label text-lg-right">Ceilling Unit</label>
                    <div class="col">
                        <select class="form-control select2" name='ceiling_unit' id="ceiling_unit" readonly="readonly"
                            required>

                            <option {{ $inquiry->roof_unit == 'sqft' ? 'selected' : '' }} value="sqft">
                                sq.Footer</option>
                            <option {{ $inquiry->roof_unit == 'sqm' ? 'selected' : '' }} value="sqm">
                                sq.Meters </option>
                        </select>
                        @error('ceiling_unit') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="products" class="col-sm-2 col-form-label text-lg-right">Products Unit</label>
                    <div class="col">
                        <input type="text" class="form-control" id="products" name="products" readonly="readonly" required
                            @if (old('products')) value="{{ old('products') }}" @else value="{{ $inquiry->products }}" @endif />
                        @error('products') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>




            </section>
            <!--card-body-->
            <section class="card-footer">
                <div class="row">
                    <div class="col">
                        {{-- @can('INQUIRY_DELETE') --}}
                        <button type="button" url="{{ route('admin.inquiry.destroy', $inquiry->id) }}"
                            return_url="{{ route('admin.inquiry.index') }}"
                            class="btn btn-danger btn_delete">Delete</button>
                        {{-- @endcan --}}
                    </div>
                    <div class="col text-right">
                        {{-- @can('INQUIRY_EDIT') --}}
                        <button type="submit" class="btn btn-success btn_update" style="display: none;">Update</button>
                        <button type="button" class="btn btn-primary btn_edit">Edit</button>
                        {{-- @endcan --}}
                    </div>
                </div>
            </section>
            <!--card-footer-->
        </article>
        <!--card-->

        </x-forms.post>

    @endsection
