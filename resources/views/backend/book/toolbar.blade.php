@can('BOOK_CREATE')
<aside class="col-6">
    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">

        @include('backend.book.import_modal')
        <aside class="btn-group">
        @can('BOOK_IMPORT')
        <a href="#" class="d-print-none btn btn-dark" title="CSV import"><i class="fas fa-upload"
                data-toggle="modal" data-target="#importModal"></i></a>
        @endcan
        
        <a href="#" class="d-print-none btn btn-secondary" title="CSV export"><i class="fas fa-download"
            data-toggle="modal" data-target="#"></i></a>
        <a href="#" class="d-print-none btn btn-secondary" title="PDF export"><i class="fas fa-file-pdf"
            data-toggle="modal" data-target="#"></i></a>
        </aside>

        @if($viewmode=='grid')
        <a href="{{ route('admin.book.index', ['viewmode'=>'list']) }}" class="d-print-none btn btn-secondary ml-1"
            data-toggle="tooltip" title="List view"><i class="fas fa-list"></i></a>
        @else
        <a href="{{ route('admin.book.index', ['viewmode'=>'grid']) }}" class="d-print-none btn btn-secondary ml-1"
            data-toggle="tooltip" title="Grid view"><i class="fas fa-th"></i></a>
        @endif

        @can('BOOK_CREATE')
        <a href="{{ route('admin.book.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Add New"><i
                class="fas fa-plus-circle"></i></a>
        @endcan
    </div>
    <!--btn-toolbar-->
</aside>
@endcan
<!--col-->