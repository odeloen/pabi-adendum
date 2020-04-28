<table class="table table-bordered table-hover datatable-basic">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>Nama Ujian</th>
            <th>Tanggal Lulus</th>
            <th>Tanggal Validasi</th>
            <th>Jenis Ujian</th>
            @if(empty($view) && $view != 'view')
            @if(session('pabi_role_id') != 4)
            <th>Ubah</th>
            @endif
            <th>Hapus</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @include('public_admin.include.function')
        @php
        $i=1; 
        @endphp
        @if ($data_ujian !== null)
        @foreach ($data_ujian as $du)
        <?php 
        $member_ujian_id = $du['id']; 
        $member_id = $du['member_id']; 
        ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $du['nama_ujian'] }}</td>
            <td>{{ $du['tgl_lulus'] }}</td>
            <td>{{ $du['valid_until'] }}</td>
            <td>{{ $du['jenis'] }}</td>
            @if(empty($view) && $view != 'view')
            @if(session('pabi_role_id') != 4)
            <td>
                <span>
                    <button onclick="update_myprofile_member_ujian('{{csrf_token()}}','{{ $member_ujian_id }}','{{ $member_id }}')" class="btn btn-indigo btn-xs">
                        <i class="glyphicon glyphicon-edit"></i>
                    </button>
                </span>
            </td>
            @endif
            <td>
                <span>
                    <button onclick="delete_myprofile_member_ujian('{{csrf_token()}}','{{ $member_ujian_id }}','{{ $member_id }}')" class="btn btn-danger btn-xs">
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