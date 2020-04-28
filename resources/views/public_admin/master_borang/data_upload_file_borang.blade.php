<table class="table table-bordered table-hover datatable-basic">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>Nama File</th>
            <th>File</th>
            <th>Keterangan</th>
            @if (session('pabi_role_id') == 4)
            <th width="1%">Delete</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @php
        $i=1; 
        @endphp
        @if ($data_file !== null)
        @foreach ($data_file as $df)
        <?php 
        $borang_file_id = $df['id']; 
        ?>
        <tr>
            <td>{{ $i++ }}</td> 
            <td>{{ $df['nama'] }}</td>
            <td>
                <a href="{{env('URL_API_IP')}}{{ $df['path_file'] }}" target="_blank">
                    File
                </a> 
            </td>
            <td>{{ $df['keterangan'] }}</td>
            @if (session('pabi_role_id') == 4)
            <td>
                <span>
                    <button onclick="hapus_borang_file('{{csrf_token()}}','{{$borang_file_id}}')" class="btn btn-danger btn-xs">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                </span>
            </td>
            @endif
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script type="text/javascript"> 
    if($('.select22').length){
        $('.select22').select2();
    }
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px' 
        }], 
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            // searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    }); 
    $('.datatable-basic').DataTable();
    // END SCRIPT TABEL 
</script>