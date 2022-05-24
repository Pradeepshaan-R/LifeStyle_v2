@extends('backend.layouts.app')
@section('title', 'Book import')

@push('after-scripts')
<script>
    $(function() {
        $("#selectall").on("change", function(e) {
            if ($(this).prop('checked')) {
                $(".book_list").attr("checked", true);
                $(".lbl_selectall").html("Unselect All");
            } else {
                $(".book_list").attr("checked", false);
                $(".lbl_selectall").html("Select All");
            }
        });
    });
</script>
<script>
    //TODO: do we need a timer?
    async function validate(key) {
        var isbn = $("#"+key+"_isbn").val();
        var title = $("#"+key+"_title").val();
        console.log('title = '+title);

        var url = '{{url("/admin/book/check_duplicate/")}}' + '/';
        await $.get(url + isbn, function(e) {
            if(e.duplicate == true){
                isbn = false;
                $("#"+key+"_isbn").addClass('is-invalid');
                console.log('duplicate = true: isbn='+isbn);
            } else {
                isbn = $("#"+key+"_isbn").val();
                $("#"+key+"_isbn").removeClass('is-invalid');
                console.log('duplicate = false: isbn='+isbn);
            }
        });
        
        if(isbn != false && title){
            console.log('tmp = chk: isbn='+isbn);
            var tmp = ' <input class="book_list form-control form-control-sm" type="checkbox" value="'+key+'" name="books[]">';
            $("#"+key+"_approve").html(tmp);
        }else{
            console.log('tmp = btn: isbn='+isbn);
            var tmp ='<small class="btn btn-danger btn-sm">Error</small>';
            $("#"+key+"_approve").html(tmp);
        }
    }
</script>
<script>
    $(document).ready(function(e) {
    $('#dtable').DataTable({
        'columnDefs': [
                { orderable: false, targets: -1 }
            ],
        'paging': false,
        'searching': false,
        "info": false
    });
});
</script>
@endpush

@section('content')
<x-forms.patch :action="route('admin.book.import_store')" class="was-validated" id="myForm">
    <article class="card">
        <section class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">
                        Book <small class="text-muted mode_label">Import</small>
                    </h4>
                </div>
                <!--col-->

                <div class="col-4">
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
            @if(count($csv_data)>0)
            <div class="form-check float-right">
                <input class="form-check-input" type="checkbox" id="selectall">
                <label class="form-check-label lbl_selectall" for="selectall">
                    Select All
                </label>
            </div>
            @endif
            <table class="table table-hover table-sm" id="dtable">
                <thead>
                    <th>Qty</th>
                    <th>Status</th>
                    <th class="text-danger">ISBN</th>
                    <th class="text-danger">Title</th>
                    <th class="text-danger">Author</th>
                    <th>Select</th>
                </thead>
                <tbody>
                    @foreach($csv_data as $key=>$one)
                    @if($one->isDuplicate==true || $one->isbn==null || $one->title==null){{$isError=true;}} @else
                    {{$isError=false;}}@endif
                    <tr>
                        <td> <input type="text" id="{{ $key }}_qty"
                                class="form-control form-control-sm {{ $one->qty == null? 'is-invalid':''}}"
                                name="qty[]" value="{{ $one->qty }}" onkeyup="validate({{ $key }})"></td>
                        <td><select class="form-control form-control-sm {{ $one->status == null ? 'is-invalid':''}}"
                                name='status[]' id="{{ $key }}_status" onchange="validate({{ $key }})">
                                @foreach( App\Models\Book::getEnum('status') as $status)
                                <option value="{{ $status }}" {{ $one->status == $status ? 'selected':''}}>{{ $status
                                    }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" required id="{{ $key }}_isbn" class="form-control form-control-sm"
                                name="isbn[]" value="{{ $one->isbn }}" onkeyup="validate({{ $key }})">
                            <span class="invalid-feedback">Empty or Duplicate found</span>
                        </td>
                        <td><input type="text" required id="{{ $key }}_title" class="form-control form-control-sm"
                                name="title[]" value="{{ $one->title }}" onkeyup="validate({{ $key }})">
                            <span class="invalid-feedback">Cannot be empty</span>
                        </td>
                        <td><select required
                                class="form-control form-control-sm {{ $one->status == null? 'is-invalid':''}}"
                                name='author_id[]' id="{{ $key }}_author_id" onchange="validate({{ $key }})">
                                @foreach( App\Models\Author::getAuthors() as $author)
                                <option value="{{ $author->id }}" {{ $one->author_id ==$author->id ? 'selected':''}}>{{
                                    $author->name
                                    }}</option>
                                @endforeach
                            </select></td>
                        <td>
                            <div id="{{ $key }}_approve">
                                @if($isError)
                                <small class="btn btn-danger btn-sm">Error</small>
                                @else
                                <input class="book_list form-control form-control-sm" type="checkbox" value="{{ $key }}" name="books[]">
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
        <!--card-body-->

        <section class="card-footer">
            <div class="row">
                <div class="col">
                </div>
                <div class="col text-right">
                    @can('BOOK_IMPORT')
                    <button type="submit" class="btn btn-primary btn_edit">Import</button>
                    @endcan
                </div>
            </div>
        </section>
        <!--card-footer-->
    </article>
    <!--card-->
    <p class="text-center text-muted"><small>Only the validated data will be imported to database.</small></p>
</x-forms.patch>

@endsection