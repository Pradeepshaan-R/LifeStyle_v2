@extends('backend.layouts.app')
@section('title', 'Brand view')

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
        margin-top:5px;
        width: 200px;
        height: 150px;
        border: 1px solid #a7a7a7;
        background-position: center;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<x-forms.patch :action="route('admin.brand.update',$brand)" class="was-validated" id="myForm" enctype="multipart/form-data">
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">
                        Brand <small class="text-muted mode_label">View</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-4">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.brand.index') }}" title="Close" class="btn btn-light btn-sm"><i
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
                        @if(old('title')) value="{{old('title')}}" @else value="{{$brand->title}}" @endif />
                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label text-lg-right">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name='status' id="status" readonly="readonly">
                        @foreach( App\Models\Brand::getEnum('status') as $status)
                        <option value="{{ $status }}" {{ $brand->status == $status ? 'selected':''}}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label text-lg-right">Cover photo</label>
                <div class="col-sm-10">
                    <input type="file" id="photo" name="photo" accept="image/*" />
                    <div id="display_image">@if($brand->photo)<img src="{{asset('storage/brands/'.$brand->photo)}}" width="200" height="150" />@endif</div>
                </div>
            </div>
        </section>
        <!--card-body-->
        <section class="card-footer">
            <div class="row">
                <div class="col">
                    @can('BRAND_DELETE')
                    <button type="button" url="{{ route('admin.brand.destroy', $brand->id) }}"
                        return_url="{{ route('admin.brand.index')}}" class="btn btn-danger btn_delete">Delete</button>
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