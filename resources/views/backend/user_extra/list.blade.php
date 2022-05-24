@extends('backend.layouts.app')
@section('title', 'User list')

@push('after-scripts')


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
                    User <small class="text-muted">List</small>
                </h4>
            </aside>
            <!--col-->

            @can('USEREXTRA_CREATE')
            <aside class="col-6">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.user_extra.create') }}" class="btn btn-success ml-1" data-toggle="tooltip"
                        title="Add New"><i class="fas fa-plus-circle"></i></a>
                </div>
                <!--btn-toolbar-->
            </aside>
            @endcan
            <!--col-->
        </section>
        <!-- row -->

        <x-forms.get :action="route('admin.user_extra.index')" autocomplete="off">
            @csrf
            <aside class="row">
                <div class="col-3">
                    <input type="search" name="name" class="form-control" placeholder="Search by Name"
                        value="{{$name}}" />
                </div>

                <div class="col-3">
                    <select class="form-control" name='status' id="status">
                        <option value="-1">All</option>
                        @foreach( App\Models\UserExtra::getEnum('status') as $status)
                        <option value="{{ $status }}" {{ $oldStatus==$status ? 'selected' :''}}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <select class="form-control" name='role' id="role">
                        <option value="-1">All</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
            </aside>
        </x-forms.get>
        <!--form-->

        <!-- USER LIST VIEW TABLE START -->
        <section class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dtable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_list as $one)
                            <tr>
                                <td><a href="{{ url('admin/user_extra') }}/{{$one->id}}">{{ $one->name }}</a><br />
                                    @if ($one->active)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Disabled</span>
                                    @endif
                                </td>
                                <td>{{ $one->email }}</td>
                                <td>{{ $one->phone }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="user_actions">
                                        <a href="{{ url('admin/user_extra') }}/{{ $one->id }}" data-toggle="tooltip"
                                            data-placement="top" title="View" class="btn btn-info">
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
        <!-- USER LIST VIEW TABLE END -->
        <!--row-->

        <section class="row">
            <div class="col-7">
                <div class="float-left">
                    {{ $user_list->total() }} {{ Str::plural('User', $user_list->total()) }}
                </div>
            </div>
            <!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $user_list->render() !!}
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