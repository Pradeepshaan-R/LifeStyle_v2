@extends('backend.layouts.app')
@section('title', 'Book create')
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
        margin-top:5px;
        width: 200px;
        height: 150px;
        border: 1px solid #a7a7a7;
        background-position: center;
        background-size: cover;
    }
</style>
<x-forms.post :action="route('admin.book.store')" class="was-validated" id="myForm" enctype="multipart/form-data">

    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title">
                        Book <small class="text-muted mode_label">Create</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-2">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.book.index') }}" title="Close" class="btn btn-light btn-sm"><i
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

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title of the book"
                        value="{{old('title')}}" required />
                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <label for="author" class="col-sm-2 col-form-label text-lg-right">Author</label>
                <div class="col-sm-4">
                    <select class="form-control" name='author_id' id="author_id" required>
                        <option value="">Select author</option>
                        @foreach( App\Models\Author::get() as $author)
                        <option value="{{ $author->id }}" {{ old('author_id')==$author->id ? 'selected':''}}>{{
                            $author->name }}</option>
                        @endforeach
                    </select>
                    @error('author_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="isbn" class="col-sm-2 col-form-label text-lg-right">ISBN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" required
                        value="{{old('isbn')}}" />
                    @error('isbn') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label text-lg-right">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name='status' id="status">
                        @foreach( App\Models\Book::getEnum('status') as $status)
                        <option value="{{ $status }}" {{ old('status')==$status ? 'selected' :''}}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label text-lg-right">Cover photo</label>
                <div class="col-sm-10">
                    <input type="file" id="photo" name="photo" accept="image/*" />
                    <div id="display_image"></div>
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
                    @can('BOOK_CREATE')
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