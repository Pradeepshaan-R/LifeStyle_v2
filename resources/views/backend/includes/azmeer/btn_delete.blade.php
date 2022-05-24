<script>
    $(function() {
        $('.btn_delete').on('click', function() {
                var url = $(this).attr('url'); 
                var return_url = $(this).attr('return_url');        
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure you want to delete this item?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(v => {
                    console.log(v.value);
                    if(v.value){
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _method: 'delete',
                                _token: '@php echo csrf_token(); @endphp'
                            },
                            success: function(data) {
                                Swal.fire({
                                    icon:'success',
                                    title:'Delete successful',
                                    text:'Delete successful',
                                })
                                window.location = return_url;
                            }
                        });	
                    }
                });       
            })
});   
</script>