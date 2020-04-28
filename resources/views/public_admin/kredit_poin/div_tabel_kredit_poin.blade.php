<table class="table table-bordered table-hover datatable-basic">
	<thead>
        <tr>
            <th style="width: 1%">No</th>
            <th>
                Nama Member
            </th>  
            @for ($i = 0; $i < count($data_bulan_tahun); $i++)
            <th>
                {{ $data_bulan_tahun[$i] }} 
            </th>
            @endfor
        </tr>
    </thead>
    <tbody> 
        <?php $no=0; ?>
        @foreach ($data_member as $r)
        <?php $no++; ?>
        <tr>
            <td align="center" style="width: 1%">
                <?php echo $no; ?>
            </td> 
            <td>
                {{ $r['firstname'] }} {{ $r['lastname'] }}
            </td> 
            @for ($i = 1; $i <= count($data_bulan_tahun); $i++)
            <td align="center">
                Point Keseluruhan: <b>{{ $r['poin_total_'.$i] }}</b>
                <br>
                Point yang Diperoleh: <b>{{ $r['poin_setuju_verif_'.$i] }}</b>
                <br>
                Point yang Diproses: <b>{{ $r['poin_belum_verif_'.$i] }}</b>
                <br>
                Point yang Ketolak: <b>{{ $r['poin_tolak_verif_'.$i] }}</b>
            </td>
            @endfor
        </tr>
        @endforeach
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