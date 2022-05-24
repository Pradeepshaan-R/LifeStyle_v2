@extends('backend.layouts.app')
@section('title', 'Inquiry list')

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
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: true,
                theme: "bootstrap"
            });
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var path = "{{ url('admin/inquiry/autocomplete') }}";

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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month')
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
                'columnDefs': [{
                    orderable: false,
                    targets: -1
                }],
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
                        Inquiry <small class="text-muted">List</small>
                    </h4>
                </aside>
                <!--col-->

                <aside class="col-6">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ url('admin/inquiry/export_csv') }}" class="d-print-none btn btn-secondary"
                            title="CSV export"><i class="fas fa-download" data-toggle="modal" data-target="#"></i></a>
                </aside>

            </section>
            <section>
                <x-forms.get :action="route('admin.inquiry.index')" autocomplete="off">
                    @csrf
                    <aside class="row">
                        <div class="col-3">
                            <input type="search" id="title" name="title" class="form-control"
                                placeholder="Search by Inquirer name" value="{{ $name }}" />
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" name="daterange" id="daterange" />
                        </div>

                        <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                    </aside>
                </x-forms.get>
                <!--form-->
                <!--btn-toolbar-->
            </section>
        </div>
        <!--card-body-->
    </div>
    <!--card-->

    <x-backend.card>
        <x-slot name="body">
            <section class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dtable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Roofing Area</th>
                                    <th>Roofing Unit</th>
                                    <th>Ceiling Area</th>
                                    <th>Ceiling Unit</th>
                                    <th>Products</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquiry_list as $one)
                                    <tr>
                                        <td>
                                            <a href="{{ url('admin/inquiry') }}/{{ $one->id }}">{{ $one->name }}
                                            </a>
                                        </td>
                                        <td>{{ $one->phone }}</td>
                                        <td>{{ $one->roof_area }}</td>
                                        <td>{{ $one->roof_unit }}</td>
                                        <td>{{ $one->ceiling_area }}</td>
                                        <td>{{ $one->ceiling_unit }}</td>
                                        <td>{{ $one->producs }}</td>

                                        <td class="text-right">
                                            <div class="btn-group" role="group" aria-label="user_actions">
                                                <a href="{{ url('admin/inquiry') }}/{{ $one->id }}"
                                                    data-toggle="tooltip" data-placement="top" title="View"
                                                    class="btn btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--col-->
            </section>
        </x-slot>

        <x-slot name="footer">
            <section class="row">
                <div class="col-7">
                    <div class="float-left">
                        {{ $inquiry_list->total() }} {{ Str::plural('Inquiry', $inquiry_list->total()) }}
                    </div>
                </div>
                <!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $inquiry_list->render() !!}
                    </div>
                </div>
                <!--col-->
            </section>
            <!--row-->
        </x-slot>
    </x-backend.card>
@endsection
