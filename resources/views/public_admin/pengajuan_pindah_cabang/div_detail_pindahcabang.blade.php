@include('public_admin.include.function')
<div class="form-horizontal" >
    <div class="modal-body">  
        <div class="row" >   
            <?php
            $no = 0;
            ?>
            @foreach ($data_pindah_cabang as $r)
            <?php
            $no++;
            $id = $r['id'];
            
            $s_ver_cab = '<span class="label label-flat border-grey text-grey-600">Belum Diajukan</span>'; 
            
            $s_ver_pst = '<span class="label label-flat border-grey text-grey-600">Belum Diajukan</span>'; 

            $created_at = date('d F Y H:i:s', strtotime($r['created_at']));

            $status = '<span class="label label-flat border-grey text-grey-600">Menunggu Persetujuan Cabang '.$r['dari_cabang_nama'].'</span>'; 
            if($r['cabang_lama_verif'] !== null && $r['cabang_baru_verif'] === null){
                $status = '<span class="label label-flat border-info text-grey-600">Menunggu Persetujuan Cabang '.$r['ke_cabang_nama'].'</span>'; 
            } else if ($r['cabang_baru_verif'] === 1) {
                $status = '<span class="label label-flat border-success text-success-600">Disetujui Cabang '.$r['ke_cabang_nama'].' tanggal '.tgl_indo($r['cabang_baru_tgl']).'</span>'; 
            } else if ($r['cabang_baru_verif'] > 1) {
                $status = '<span class="label label-flat border-danger text-danger-600">Ditolak Cabang '.$r['ke_cabang_nama'].' tanggal '.tgl_indo($r['cabang_baru_tgl']).'</span>'; 
            }
            ?>  
            <div class="col-sm-12" >
                <div class="panel panel-flat border-left-danger row"> 
                    <div class="panel-body col-sm-1" style=" text-align: center;vertical-align: center "> 
                        {{$no}}.
                    </div> 
                    <div class="panel-body col-sm-11" style=" border-left:1px solid #DCDCDC ; "> 
                        <ul>
                            <li>
                                Status = <b>{!!$status!!}</b>
                            </li>
                            <li>
                                Cabang Asal = <b>{{$r['dari_cabang_nama']}}</b>
                            </li>
                            <li>
                                Cabang Tujuan = <b>{{$r['ke_cabang_nama']}}</b>
                            </li>
                            <li> 
                                Tanggal Mengajukan = <b>{!! tgl_indo($r['tanggal_masuk']) !!}</b>
                            </li> 
                        </ul>  
                    </div> 
                </div>
            </div>  
            @endforeach  
        </div> 
    </div> 
</div> 