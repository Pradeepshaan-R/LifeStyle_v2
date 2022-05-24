<main class="row mt-4">
    @foreach ($book_list as $book)
    <section class="col-md-4 col-lg-3">
        <aside class="card">
            <div class="card-header text-center bg-secondary">
                <h5 class="card-title">{{ $book->title }}</h5>
                @switch($book->status)
                @case('Damaged')
                <?php $status_color='danger'; ?>
                @break
                @case('Lended')
                <?php $status_color='info'; ?>
                @break
                @default
                <?php $status_color='success'; ?>
                @endswitch
                <small class="badge badge-{{$status_color}}">{{ $book->status }}</small>
            </div>

            <div class="card-body text-center">
                @php if($book->photo !=
                null){$img=asset('storage/covers').'/'.$book->photo;}else{$img=asset('storage/covers/nocover.png');}
                @endphp
                <a href="{{ url('admin/book') }}/{{$book->id}}">
                    <img src="{{$img}}" class="img-thumbnail" /></a>
                <p>{{ $book->name }}</p>
                {{ $book->isbn }}
            </div>
        </aside>
    </section>
    @endforeach
</main>