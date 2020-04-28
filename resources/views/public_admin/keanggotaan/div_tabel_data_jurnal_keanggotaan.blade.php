<table class="table table-bordered table-hover datatable-basic">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>Judul Jurnal</th>
            <th>Tanggal Terbit</th>
            <th>File</th>
            @if(empty($view) && $view != 'view')
            <th>Delete</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @include('public_admin.include.function')
        @php
        $i=1; 
        @endphp
        @if ($data_jurnal !== null)
        @foreach ($data_jurnal as $dj)
        <?php 
        $member_jurnal_id = $dj['id']; 
        $member_id = $dj['member_id']; 
        ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $dj['judul'] }}</td>
            <td>{!! tgl_indo($dj['tgl_terbit']) !!}</td>
            <td>
                <a href="{{env('URL_API_IP')}}{{ $dj['file_name'] }}" target="_blank">
                    File
                </a> 
            </td>
                @if(empty($view) && $view != 'view')
            <td> 
                <span>
                    <button onclick="delete_myprofile_member_jurnal('{{csrf_token()}}','{{ $member_jurnal_id }}','{{ $member_id }}')" class="btn btn-danger btn-xs">
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