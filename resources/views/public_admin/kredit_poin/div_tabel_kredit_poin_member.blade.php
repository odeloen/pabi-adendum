<table class="table table-bordered table-hover datatable-basic">
	<thead>
        <tr>
            <th style="width: 1%">No</th>
            <th>
                Periode
            </th>  
            <th>
                Point Keseluruhan
            </th>
            <th>
                Point yang Perolehan
            </th>
            <th>
                Point yang Diproses
            </th>
            <th>
                Point yang Ketolak
            </th>
        </tr>
    </thead>
    <tbody> 
        <?php $no=0; ?>
        @for ($i = 1; $i <= count($data_bulan_tahun); $i++)
        <?php $no++; ?>
        <tr>
            <td align="center" style="width: 1%">
                <?php echo $no; ?>
            </td> 
            <td>
                {{ $data_bulan_tahun[$i-1] }}
            </td> 
            <td>
                {{ $data_member[0]['poin_total_'.$i] }}
            </td>
            <td>
                {{ $data_member[0]['poin_setuju_verif_'.$i] }}
            </td>
            <td>
                {{ $data_member[0]['poin_belum_verif_'.$i] }}
            </td>
            <td>
                {{ $data_member[0]['poin_tolak_verif_'.$i] }}
            </td>            
        </tr>
        @endfor
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