<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Daftar Buku Tamu
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div> 
                        <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th> 
                                        <th>Nama Member</th> 
                                        <th>Status Acc</th>
                                        <th>Status Hadir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($data_buku_tamu as $r) 
                                    <?php
                                    $s_acc = '<span class="label label-flat border-grey text-grey-600">Belum Acc</span>';
                                    if($r['status_acc'] == 2){
                                        $s_acc = '<span class="label label-flat border-danger text-danger-600">Ditolak</span>';
                                    } else if($r['status_acc'] == 1){
                                        $s_acc = '<span class="label label-flat border-success text-success-600">Disetujui</span>';
                                    }

                                    $s_hadir = '<span class="label label-flat border-success text-success-600">Sudah Hadir</span>';
                                    if($r['status_hadir'] == 0){
                                        $s_hadir = '<span class="label label-flat border-danger text-danger-600">Belum Hadir</span>';
                                    }
                                    $no ++;
                                    $id = $r['id'];
                                    ?>
                                    <tr>
                                        <td>{{$no}}</td> 
                                        <td>{{ $r['member_firstname'] }} {{ $r['member_lastname'] }} ({{ $r['member_nickname'] }})</td>
                                        <td><?php echo $s_acc; ?></td>
                                        <td><?php echo $s_hadir; ?></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                   
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="jumlah_data" id="jumlah_data" value="{{$no}}">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    if($('.select22').length){
        $('.select22').select2();
    } 
    $( document ).ready(function() { 

//CKEditor
// CKEDITOR.replace('ckeditors');
// CKEDITOR.config.height = 300;  
// $('.summernote').each(function(e){  
//     CKEDITOR.replace(this.id,{  
//         uiColor : '#b2cefe ' 
//     }); 

// }); 
}); 
</script>