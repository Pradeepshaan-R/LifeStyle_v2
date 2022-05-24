@extends('backend.layouts.app')
@section('title', 'Book list')

@push('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }
</style>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            closeOnSelect: true,
            theme: "bootstrap"
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    $(function() {
            var path = "{{ url('admin/book/autocomplete') }}";

            $('#title').typeahead({
                source: function(query, process) {
                    return $.get(path, {
                        query: query
                    }, function(data) {
                        return process(data);
                    });
                }
            });
        });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    $(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
        }
    }, cb);

    cb(start, end);

});
</script>

<script>
    $(document).ready(function(e) {
    $('table').DataTable({
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
<div class="card">
    <div class="card-body">
        <section class="row">
            <aside class="col-6">
                <h4 class="card-title mb-4">
                    Book <small class="text-muted">List</small>
                </h4>
            </aside>
            <!--col-->

            @include('backend.book.toolbar')
        </section>
        <!-- row -->

        <x-forms.get :action="route('admin.book.index')" autocomplete="off">
            @csrf
            <aside class="row">
                <div class="col-3">
                    <input type="search" id="title" name="title" class="form-control" placeholder="Search by Book title"
                        value="{{$title}}" />
                </div>

                <div class="col-3">
                    <select class="form-control select2" name='author_id' id="author_id">
                        <option value="">Select author</option>
                        @foreach( App\Models\Author::get() as $author)
                        <option value="{{ $author->id }}" {{ $author_id==$author->id ? 'selected':''}}>
                            {{ $author->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <input type="text" class="form-control" name="daterange" id="daterange" />
                </div>

                <input type="hidden" name="viewmode" value="{{$viewmode}}" />
                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
            </aside>
        </x-forms.get>
        <!--form-->

    </div>
    <!--card-body-->
</div>
<!--card-->

<x-backend.card>
    <x-slot name="body">
        <!-- BOOK LIST VIEW TABLE START -->
        @if($viewmode=='grid')
            @include('backend.book.inc_grid')
        @else
            @include('backend.book.inc_list')
        @endif
        <!-- BOOK LIST VIEW TABLE END -->
        <!--row-->
    </x-slot>

    <x-slot name="footer">
        <section class="row">
            <div class="col-7">
                <div class="float-left">
                    {{ $book_list->total() }} {{ Str::plural('Book', $book_list->total()) }}
                </div>
            </div>
            <!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $book_list->render() !!}
                </div>
            </div>
            <!--col-->
        </section>
        <!--row-->
    </x-slot>
</x-backend.card>
@endsection