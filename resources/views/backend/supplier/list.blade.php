@extends('backend.layouts.app')
@section('title', 'Supplier List')

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
                        Supplier <small class="text-muted">List </small>
                    </h4>
                </aside>
                <!--col-->

                <aside class="col-6">
                    @can('PRODUCT_CREATE')
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="#" class="d-print-none btn btn-secondary ml-1" data-toggle="tooltip" title="Print"
                                onclick="window.print()"><i class="fas fa-print"></i></a>
                            <a href="{{ route('admin.supplier.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                                title="Add New"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    @endcan
                </aside>

            </section>
            <section>
                <x-forms.get :action="route('admin.supplier.index')" autocomplete="off">
                    @csrf
                    <aside class="row">
                        <div class="col-3">
                            <input type="search" id="name" name="name" class="form-control"
                                placeholder="Search by Supplier Name" value="{{ $name }}" />
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
                                    <th>Supplier Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplier_list as $one)
                                    <tr>
                                        <td><a
                                                href="{{ url('admin/supplier') }}/{{ $one->id }}">{{ $one->user_name }}</a>
                                        </td>
                                        <td>{{ $one->company_name }}</td>
                                        <td>{{ $one->email }}</td>
                                        <td>{{ $one->phone }} <br> {{ $one->company_phone }}</td>
                                        <td class="text-right">
                                            <div class="btn-group" role="group" aria-label="user_actions">
                                                <a href="{{ url('admin/supplier') }}/{{ $one->id }}"
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
                        {{ $supplier_list->total() }} {{ Str::plural('Supplier', $supplier_list->total()) }}
                    </div>
                </div>
                <!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $supplier_list->render() !!}
                    </div>
                </div>
                <!--col-->
            </section>
            <!--row-->
        </x-slot>
    </x-backend.card>
@endsection
