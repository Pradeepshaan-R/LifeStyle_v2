@extends('backend.layouts.app')
@section('title', 'Brand list')

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
                        Brand <small class="text-muted">List</small>
                    </h4>
                </aside>
                <!--col-->

                <aside class="col-6">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        @can('BRAND_CREATE')
                        <a href="{{ route('admin.brand.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                            title="Add New"><i class="fas fa-plus-circle"></i></a>
                        @endcan
                    </div>
                </aside>

            </section>
            <section>
                <x-forms.get :action="route('admin.brand.index')" autocomplete="off">
                    @csrf
                    <aside class="row">
                        <div class="col-3">
                            <input type="search" id="title" name="title" class="form-control"
                                placeholder="Search by Brand name" value="{{ $title }}" />
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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brand_list as $one)
                                    <tr>
                                        <td><a href="{{ url('admin/brand') }}/{{ $one->id }}">{{ $one->title }}</a>
                                        </td>
                                        <td>{{ $one->status }}</td>
                                        <td class="text-right">
                                            <div class="btn-group" role="group" aria-label="user_actions">
                                                <a href="{{ url('admin/brand') }}/{{ $one->id }}"
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
                        {{ $brand_list->total() }} {{ Str::plural('Brand', $brand_list->total()) }}
                    </div>
                </div>
                <!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $brand_list->render() !!}
                    </div>
                </div>
                <!--col-->
            </section>
            <!--row-->
        </x-slot>
    </x-backend.card>
@endsection
