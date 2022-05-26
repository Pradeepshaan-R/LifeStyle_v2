@extends('backend.layouts.app')
@section('title', 'Stock list')

@push('after-scripts')
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
                        Stock <small class="text-muted">List </small>
                    </h4>
                </aside>
                <!--col-->

                <aside class="col-6">
                    @can('PRODUCT_CREATE')
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{ route('admin.stock.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                                title="Add New"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    @endcan
                </aside>

            </section>
            <section>
                {{-- <x-forms.get :action="route('admin.stock.index')" autocomplete="off">
                    @csrf
                    <aside class="row">
                        <div class="col-3">
                            <input type="search" id="title" name="title" class="form-control"
                                placeholder="Search by Stock Title" value="{{ $title }}" />
                        </div>

                        <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                    </aside>
                </x-forms.get> --}}
            </section>
        </div>
    </div>

    <x-backend.card>
        <x-slot name="body">
            <section class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dtable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Suplier</th>
                                    <th>Quantity</th>
                                    <th>Reg Date</th>
                                    <th>Exp. Date</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock_list as $one)
                                    <tr>
                                        <td>{{ $one->title }}</td>
                                        <td>{{ $one->user_name }}</td>
                                        <td>{{ number_format($one->quantity)}}</td>
                                         <td>{{ substr($one->registration_date, 0, 10) }}</td>
                                         <td>{{ substr($one->expiry_date, 0, 10) }}</td>
                                        <td class="text-right">
                                            <div class="btn-group" role="group" aria-label="user_actions">
                                                <a href="{{ url('admin/stock') }}/{{ $one->id }}"
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
                        {{ $stock_list->total() }} {{ Str::plural('Stock', $stock_list->total()) }}
                    </div>
                </div>
                <!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $stock_list->render() !!}
                    </div>
                </div>
                <!--col-->
            </section>
            <!--row-->
        </x-slot>
    </x-backend.card>
@endsection
