<table class="table table-bordered table-hover datatable-basic">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>Kategori Harga</th>
            <th>Harga</th>
            <th>Kuota</th>
            <th>Status</th>
            <th>Ubah / Hapus</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i=1; 
        @endphp
        @if ($data_harga !== null)
        @foreach ($data_harga as $dh)
        <?php 
        $event_harga_id = $dh['id']; 
        $event_id = $dh['event_id']; 
        $harga = "Rp " . number_format($dh['harga'],2,',','.');

        $status_harga = '';
        if($dh['status_harga'] == 1){
            $status_harga = 'checked';
        }
        ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $dh['kategori'] }}</td>
            <td align="right">{{ $harga }}</td>
            <td>
                {{ $dh['kuota_peserta'] }}
            </td>
            <td> 
                <div class="onoffswitch_acc_member_event">
                    <input {{ $status_harga }} type="checkbox" class="onoffswitch_acc_member_event-checkbox"
                    name="status_harga" id="status_harga_{{ $dh['id'] }}" onclick="chk_status_harga('{{csrf_token()}}', '{{ $id }}', '<?= $dh['id']; ?>', $(this).prop('checked'), '#status_harga_<?= $dh['id'] ?>');">
                    <label class="onoffswitch_acc_member_event-label" for="status_harga_{{ $dh['id'] }}">
                        <span class="onoffswitch_acc_member_event-inner"></span>
                        <span class="onoffswitch_acc_member_event-switch"></span>
                    </label>
                </div>
                <div id="status_harga_{{ $dh['id'] }}_loading"></div>
            </td>
            <td>
                <span>
                    <button onclick="div_data_harga_event('{{csrf_token()}}', '#div_data_harga_event', '{{ $event_id }}', '{{ $event_harga_id }}');" class="btn btn-indigo btn-xs">
                        <i class="glyphicon glyphicon-edit"></i>
                    </button>
                </span>

                <span>
                    <button onclick="delete_harga_event('{{csrf_token()}}','{{ $event_harga_id }}','{{ $event_id }}')" class="btn btn-danger btn-xs">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                </span>
            </td>
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