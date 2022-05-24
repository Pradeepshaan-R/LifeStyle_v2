<x-forms.post :action="route('admin.book.import_show')" class="was-validated" id="myForm" enctype="multipart/form-data">
    <main class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <section class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Import book collection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </section>
                <section class="modal-body">
                    <p>Please download the <a href="{{url('/storage/books_template.csv')}}">CSV
                            template</a>, fill it with data and upload it here.</p>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="file" name="books" id="books" accept=".csv">
                        </div>
                    </div>
                </section>
                <section class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continue</button>
                </section>
            </div>
        </div>
    </main>
</x-forms.post>