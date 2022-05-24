@extends('backend.layouts.app')
@section('title', 'Brand create')
@push('after-scripts')
    <script>
        const photo = document.querySelector("#photo    ");
        photo.addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                const uploaded_image = reader.result;
                document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endpush
@section('content')
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
    <x-forms.post :action="route('admin.variation.store')" class="was-validated" id="myForm" enctype="multipart/form-data">

        <article class="card">
            <section class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">
                            Variation <small class="text-muted mode_label">Create</small>
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-2">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.variation.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                    <label for="assignment_type" class="col-sm-2 col-form-label text-lg-right">Title</label>

                    <div class="col">
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Title of the variation" value="{{ old('title') }}" required />
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>


                </div>


                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label text-lg-right">Variation Type</label>
                    <div class="col-sm-10">
                        <select class="form-control" name='variation_type_id' id="variation_type_id">
                            @foreach ($variation_type as $variation_type)
                                <option value="{{ $variation_type->id }}">{{ $variation_type->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('variation_type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>



            </section>
            <!--card-body-->

            <section class="card-footer">
                <div class=" row">
                    <div class="col-sm-6">
                        <small><span class="text-danger">Red</span> boxes are mandatory. <span
                                class="text-success">Green</span> boxes are optional.</small>
                    </div>
                    <div class="col-sm-6 text-right">
                        @can('VARIATION')
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
