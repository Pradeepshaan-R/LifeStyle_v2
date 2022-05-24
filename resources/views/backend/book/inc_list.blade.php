<section class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dtable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book_list as $one)
                    <tr>
                        <td><a href="{{ url('admin/book') }}/{{$one->id}}">{{ $one->title }}</a></td>
                        <td>{{ $one->name }}</td>
                        <td>{{ $one->isbn }}</td>
                        <td>{{ $one->status }}</td>
                        <td class="text-right">
                            <div class="btn-group" role="group" aria-label="user_actions">
                                <a href="{{ url('admin/book') }}/{{$one->id}}" data-toggle="tooltip"
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