<table class="table table-bordered table-hover datatable-basic">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th>File</th>
            @if(empty($view) && $view != 'view')
            <th>Delete</th>
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
        $member_file_id = $df['id']; 
        $member_id = $df['member_id']; 
        ?>
        <tr>
            <td>{{ $i++ }}</td> 
            <td>{{ $df['jenis_file'] }}</td>
            <td>{{ $df['keterangan'] }}</td>
            <td>
                <a href="{{env('URL_API_IP')}}{{ $df['file_name'] }}" target="_blank">
                    File
                </a> 
            </td>
                @if(empty($view) && $view != 'view')
            <td>
                <span>
                    <button onclick="delete_myprofile_member_file('{{csrf_token()}}','{{ $member_file_id }}','{{ $member_id }}')" class="btn btn-danger btn-xs">
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