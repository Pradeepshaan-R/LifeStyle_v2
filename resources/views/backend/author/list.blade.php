@extends('backend.layouts.app')
@section('title', 'Author list')

@push('after-scripts')
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
            <div class="col-5">
                <h4 class="card-title mb-4">
                    Author <small class="text-muted">List</small>
                </h4>
            </div>
            <!--col-->

            @can('AUTHOR_CREATE')
            <div class="col-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.author.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                        title="Add New"><i class="fas fa-plus-circle"></i></a>
                </div>
                <!--btn-toolbar-->
            </div>
            @endcan
            <!--col-->
        </section>
        <!-- row -->

        <!-- Author LIST VIEW TABLE START -->
        <section class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <livewire:author-table /> 
                </div>
            </div>
            <!--col-->
        </section>
        <!-- Author LIST VIEW TABLE END -->
        <!--row-->

        <section class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- $book_list->total() }} {{ Str::plural('Book', $book_list->total()) --}}
                </div>
            </div>
            <!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {!! $book_list->render() !!} --}}
                </div>
            </div>
            <!--col-->
        </section>
        <!--row-->
    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection
