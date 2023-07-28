<script>
    function fn_deleteData(url)
    {
        swal.fire({
            title:"Yakin akan dihapus ?",
            text:"Data akan dihapus secara permanent !",
            type:"warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(yes) {
            if(yes){
                token = '{{csrf_token()}}';
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function (respon){
                        console.log(respon);
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
                setTimeout(function(){
                    window.location.reload();
                },1500);
            }

        });
    }
</script>
</body>
