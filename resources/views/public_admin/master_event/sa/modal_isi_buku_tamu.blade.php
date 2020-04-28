<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <!-- <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Daftar Buku Tamu
                    </a>
                </li> 
            </ul> -->

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form class="form-horizontal" enctype="multipart/form-data" id="formUpdateBukuTamuAdmin">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div> 
                            <div class="form-group">
                                <table class="table table-hover datatable-basic">
                                    <thead>
                                        <tr>
                                            <th width="1%">No</th> 
                                            <th>Nama Member</th> 
                                            <th width="15%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        @foreach ($data_buku_tamu as $r) 
                                        <?php
                                        $stat_checked ='';
                                        if($r['status_hadir']==1){
                                            $stat_checked = 'checked = "checked"';    
                                        }

                                        $acc_member ='';
                                        if($r['status_acc']==1){
                                            $acc_member = 'checked = "checked"';    
                                        }
                                        $no ++;
                                        $id = $r['id'];
                                        ?>
                                        <tr>
                                            <td>{{$no}}</td> 
                                            <td>{{ $r['member_firstname'] }} {{ $r['member_lastname'] }} ({{ $r['member_nickname'] }})</td> 
                                            <td>
                                                <input type="hidden" name="id_buku_tamu_{{$no}}" id="id_buku_tamu_{{$no}}" value="{{$id}}">
                                                <select data-placeholder="Pilih Admin Cabang" class=" " name="member_acc_{{$no}}" id="member_acc_{{$no}}" style="width: 100%">
                                                    <option value="0">Belum Di Konfirmasi</option>
                                                    <option value="1" <?php if ($r['status_acc'] == 1) { echo 'selected=""'; } ?>>
                                                        Sudah Di Konfirmasi
                                                    </option>
                                                    <option value="2" <?php if ($r['status_acc'] == 2) { echo 'selected=""'; } ?>>
                                                        Ditolak
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>                   
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="jumlah_data" id="jumlah_data" value="{{$no}}">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <a class="btn btn-primary btn-ladda btnFormUpdateBukuTamuAdmin" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" onclick="simpan_form_update_buku_tamu_admin('{{csrf_token()}}', '.btnFormUpdateBukuTamuAdmin')">
                                <i class="icon-check"></i> Simpan
                            </a>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
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