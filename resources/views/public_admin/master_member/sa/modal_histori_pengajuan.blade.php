<div class="row">
    <div class="col-lg-12"> 
        <div>  
            <table class="table table-bordered table-hover datatable-basic table-responsive-xl">
                <thead>
                <tr>
                    <th width="1%">No</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 0;
                ?>
                @foreach ($data_pengajuan as $r)
                <?php
                $no++;
                $id = $r['id'];
                
                $s_ver_cab = '<span class="label label-flat border-grey text-grey-600">Belum Diajukan</span>';
                if ($r['cabang_verif'] == 3) {
                    $s_ver_cab = '<span class="label label-flat border-danger text-danger-600">Ditolak</span>';
                } else if ($r['cabang_verif'] == 2) {
                    $s_ver_cab = '<span class="label label-flat border-success text-success-600">Disetujui</span>';
                } else if ($r['cabang_verif'] == 1) {
                    $s_ver_cab = '<span class="label label-flat border-primary text-primary-600">Progress</span>';
                }
                
                $s_ver_pst = '<span class="label label-flat border-grey text-grey-600">Belum Diajukan</span>';
                if ($r['pusat_verif'] == 3) {
                    $s_ver_pst = '<span class="label label-flat border-danger text-danger-600">Ditolak</span>';
                } else if ($r['pusat_verif'] == 2) {
                    $s_ver_pst = '<span class="label label-flat border-success text-success-600">Disetujui</span>';
                } else if ($r['pusat_verif'] == 1) {
                    $s_ver_pst = '<span class="label label-flat border-primary text-primary-600">Progress</span>';
                } 

                $created_at = date('d F Y H:i:s', strtotime($r['created_at']));
                ?>
                <?php 
                if($r['cabang_verif'] == 1 && $r['pusat_verif'] === null){
                ?>
                <tr>
                    <td>{{$no}}</td>
                    <td>
                        <span class="label label-flat border-primary text-primary-600">
                            Mengajukan pada <b>{{ $created_at }}</b>
                        </span>
                    </td>
                </tr>
                <?php 
                } else if($r['cabang_verif'] > 1 && $r['pusat_verif'] <= 1){ 
                ?>
                <tr>
                    <td>{{$no}}</td>
                    <td>
                        <?= $s_ver_cab ?> Admin Cabang, pada <b>{{date('d F Y', strtotime($r['cabang_tgl']))}}</b>, Menunggu Verifikasi Admin Pusat
                    </td>
                </tr>
                <?php  
                } else if($r['cabang_verif'] > 1 && $r['pusat_verif'] > 1){ 
                ?>
                <tr>
                    <td>{{$no}}</td>
                    <td> 
                        <?= $s_ver_pst ?> Admin Pusat, pada <b>{{date('d F Y', strtotime($r['pusat_tgl']))}}</b> 
                    </td>
                </tr>
                <?php 
                }
                ?>
                @endforeach
                </tbody>
            </table>  
        </div>  
    </div>
</div> 
<script type="text/javascript">  
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