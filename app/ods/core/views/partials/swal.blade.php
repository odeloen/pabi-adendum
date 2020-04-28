@if (Session::has('swal'))
    <script>
        var swalConfig = {!!Session::get('swal')!!}
        console.log(swalConfig)
        swal({
            html: true,
            title: swalConfig.title,
            text: swalConfig.text,
            type: swalConfig.type,            
        })
    </script>    
@endif    