@extends('backend.layouts.app')
@section('title', 'Book view')

@push('after-scripts')
@include('backend.includes.azmeer.btn_delete')
<script>
    //multi function edit/update button with input:readyonly control
$(function() {
    var isEditable = false;
    $('.btn_edit').on('click', function() {
        isEditable = true;
        $('.btn_edit').hide();
        $('.btn_update').show();
        $('.mode_label').text('Update');
        $('form input, form select, form textarea, form select option').each(
            function(index) {
                $(this).removeAttr('readonly');
                $(this).removeAttr('disabled');
            }
        );
    });
});
</script>
@endpush

@section('content')
<article class="card">
    <section class="card-header">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title">
                    Help <small class="text-muted mode_label">View</small>
                </h4>
            </div>
            <!--col-->

            <div class="col-4">
            </div>
            <!--col-->
        </div>
        <!--card-header-actions-->
    </section>
    <!--card-header-->

    <section class="card-body">

        <p>Help text will be here</p>

    </section>
    <!--card-body-->
    <section class="card-footer">
        <div class="row">
            <div class="col">
                <button type="button" url="" class="btn btn-info">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <div class="col text-right">
                <button type="button" class="btn btn-info">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>
    <!--card-footer-->
</article>
<!--card-->
<p class="text-center text-muted"><small></small></p>

@endsection