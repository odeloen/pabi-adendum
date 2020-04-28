@extends('public_admin.index')
@section('tempat_content')
@include('public_admin.include.function')
<!-- Main charts -->
<div class="row">
    <?php
    $cek_pengajuan = 'tidak';
    $id_member = $data_member['id'];
    if ($data_member['cabang_verif'] !== null || $data_member['cabang_verif'] !== null) { 
        $cek_pengajuan = 'ya';
    }  
    ?>
    <input type="hidden" name="pengajuan_status" value="{{ $cek_pengajuan }}" id="pengajuan_status">

    <div class="col-lg-12">
        <!-- Panel Event -->
        <div class="panel panel-indigo ">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a href=".div_histori_pengajuan" class="collapsed" data-toggle="collapse"
                       onclick="tgl('.arrow_bag_history')">
                        <i class="icon-arrow-down12 arrow_bag_history" style="display: none"></i>
                        <i class="icon-arrow-up12 arrow_bag_history"></i>
                        Riwayat Pengajuan Membership
                    </a>
                </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="reload"></a></li>
                    </ul>
                </div>
            </div>
            <div class="collapse div_histori_pengajuan">
                <div class="panel-body"> 
                    <div class="" style="overflow-x:auto;">
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

                    <div class="text-right">

                    </div>
                </div>
            </div>
        </div> 
        <div class="panel panel-indigo ">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a href=".div_histori_pengajuan_pindah_cabang" class="collapsed" data-toggle="collapse"
                       onclick="tgl('.arrow_bag_history_pindah_cabang')">
                        <i class="icon-arrow-down12 arrow_bag_history_pindah_cabang" style="display: none"></i>
                        <i class="icon-arrow-up12 arrow_bag_history_pindah_cabang"></i>
                        Riwayat Perpindahan Cabang
                    </a>
                </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="reload"></a></li>
                    </ul>
                </div>
            </div>
            <div class="collapse div_histori_pengajuan_pindah_cabang">
                <div class="panel-body"> 
                    <div class="row" >   
                        <?php
                        $no = 0;
                        if(sizeof($data_pengajuan_pindah_cabang) > 0){ 
                        ?>
                        @foreach ($data_pengajuan_pindah_cabang as $r)
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
                        if ($r['cabang_lama_verif'] > 1 && $r['cabang_baru_verif'] === null) {
                            $status = '<span class="label label-flat border-danger text-danger-600">Ditolak Cabang '.$r['dari_cabang_nama'].' tanggal '.tgl_indo($r['cabang_lama_tgl']).'</span>'; 
                        }

                        if ($r['cabang_lama_verif'] === 2 && $r['cabang_baru_verif'] === 2 && $r['cabang_baru_tgl'] === null ) {
                            $status = '<span class="label label-flat border-danger text-danger-600">Ditolak Cabang '.$r['dari_cabang_nama'].' tanggal '.tgl_indo($r['cabang_lama_tgl']).'</span>'; 
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
                        <?php 
                        } else {
                            echo '<h3>Tidak ada histori</h3>';
                        } 
                        ?>
                    </div> 
                </div>
            </div>
        </div>
        <div class="panel panel-indigo">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a href=".div_data_member_all" class="collapsed" data-toggle="collapse" onclick="tgl('.arrow_data_member_all')">
                        <i class="icon-arrow-down12 arrow_data_member_all"></i>
                        <i class="icon-arrow-up12 arrow_data_member_all" style="display: none"></i>
                        Data Member
                    </a>
                </h6> 
                <div class="heading-elements">
                    <ul class="icons-list"> 
                        <li><a data-action="reload"></a></li>
                    </ul>
                </div>
            </div>
            <div class="collapse in div_data_member_all">
                <div class="panel-body">
                    <div class="tab-pane active" id="tab_data_dokter">
                        <div class="row">  
                            <div class="col-md-6" align="center">
                                <form method="post" action="{{ route('simpan_pengajuan_member_m', $data_member['id']) }}"
                                      class="form-horizontal" enctype="multipart/form-data"
                                      onsubmit="if ($('#pengajuan_status').val() == 'ya') { alert('Masih dalam tahap pengajuan'); return false; } else { ladda_start('.btn_ajukan_pengajuan'); }">
                                    <div class="form-group">
                                        {{ csrf_field() }}
                                    </div>
                                    <?php
                                    if(request()->session()->get('pabi_cabang_verif') > 1 
                                        && request()->session()->get('pabi_pusat_verif') != 3){
                                    ?>
                                    <button type="button" onclick="alertKu('warning', 'Pengajuan sudah dilakukan');" type="button" class="btn btn-danger btn-ladda btn_ajukan_pengajuan" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                                        Ajukan Pengajuan Membership
                                        <i class="icon-arrow-right14 position-right"></i>
                                    </button>
                                    <?php
                                    }
                                    else {
                                    ?>
                                    <button type="submit" class="btn bg-indigo btn-ladda btn_ajukan_pengajuan" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                                        Ajukan Pengajuan Membership
                                        <i class="icon-arrow-right14 position-right"></i>
                                    </button>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="col-md-6" align="center">
                                <form method="post" class="form-horizontal" enctype="multipart/form-data" >
                                    <div class="form-group">
                                        {{ csrf_field() }}
                                    </div>
                                    <?php
                                    if(request()->session()->get('pabi_pusat_verif') < 2  ){
                                    ?>
                                    <button type="button" onclick="alertKu('warning', 'Pengajuan Member Masih Dalam Proses');" type="button" class="btn btn-danger btn-ladda btn_ajukan_pengajuan_pindah_cabang" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                                        Ajukan Perpindahan Cabang
                                        <i class="icon-arrow-right14 position-right"></i>
                                    </button>
                                    <?php
                                    }
                                    else {
                                    ?>
                                    <button type="button" class="btn bg-teal-400 " onclick="modal_pengajuan_pindah_cabang('{{csrf_token()}}', '{{ $id_member }}', '#ModalTealSm'); ">
                                        Ajukan Perpindahan Cabang
                                        <i class="icon-arrow-right14 position-right"></i>
                                    </button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <!-- START Foto Profile  -->
                        <div class="row">  
                            <div class="col-md-12">
                                @if (session()->has('status'))
                                <script type="text/javascript">
                                    alertKu('success', "{{ session()->get('status') }}");
                                </script>
                                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>×</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span class="text-semibold">Berhasil! </span> {{ session()->get('status') }}
                                    {{session()->forget('status')}}
                                </div>
                                @endif
                                @if (session()->has('statusT'))
                                <div class="alert alert-warning alert-styled-left">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>×</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <span class="text-semibold">Gagal!<br></span> {{ session()->get('statusT') }}
                                    {{session()->forget('statusT')}}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12" align="center">  
                                <button type="button" class="btn btn-primary btn-ladda btn_detail_pengajuan" onclick="detail_pengajuan('{{csrf_token()}}', '{{ $id_member }}');">
                                    Detail Pengajuan
                                    <i class="icon-book position-right"></i>
                                </button> 
                            </div>
                            <br>
                            <div class="col-md-12" id="div_foto_profile_keanggotaan">
                            </div>
                        </div>
                        <!-- END Foto Profile  -->

                        <!-- START Data IDI -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_1" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_data_idi_keanggotaan').val() == '') {
                                        div_data_idi_keanggotaan('{{csrf_token()}}', '#div_data_idi_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_data_idi_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_1');
                                    ">
                                    <h6 class="panel-title" style="color:white;">
                                        <input type="hidden" id="tab_div_data_idi_keanggotaan">

                                        <i class="icon-arrow-down12 arrow_bag_1" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_1" ></i>

                                        <i class="fa fa-user-md position-left"></i> <strong>DATA IDI</strong>
                                    </h6>

                                </a>
                            </div>
                            <div class="collapse div_bag_1">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_data_idi_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data IDI -->

                        <!-- START IDENTITAS DIRI -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_2" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_identitas_diri_keanggotaan').val() == '') {
                                        div_identitas_diri_keanggotaan('{{csrf_token()}}', '#div_identitas_diri_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_identitas_diri_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_2');
                                    ">
                                    <h6 class="panel-title" style="color:white">
                                        <input type="hidden" id="tab_div_identitas_diri_keanggotaan">
                                        <i class="icon-arrow-down12 arrow_bag_2" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_2" ></i>
                                        <i class="fa fa-address-book position-left"></i> <strong>IDENTITAS DIRI</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_2">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_identitas_diri_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END IDENTITAS DIRI --> 

                        <!-- START Data Bank -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_12" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_bank_keanggotaan').val() == '') {
                                    div_data_bank_keanggotaan('{{csrf_token()}}', '#div_data_bank_keanggotaan', '{{ $id_member }}'); 
                                    $('#tab_div_data_bank_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_12');
                                ">
                                <h6 class="panel-title" style="color:white;">
                                    <input type="hidden" id="tab_div_data_bank_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_12" style="display: none"></i>
                                    <i class="icon-arrow-up12 arrow_bag_12"></i>
                                    <i class="fa fa-money-bill-wave position-left"></i> <strong>DATA REKENING BANK</strong>
                                </h6></a>
                            </div>
                            <div class="collapse div_bag_12">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_bank_keanggotaan">

                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Bank -->

                        <!-- START Data Nomor Anggota -->
                        <div class="panel panel-primary" style="display: none;">
                            <div class="panel-heading">
                                <a href=".div_bag_no_anggota_pabi" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_nomor_anggota_pabi').val() == '') {
                                        div_nomor_anggota_pabi('{{csrf_token()}}', '#div_nomor_anggota_pabi', '{{ $id_member }}');
                                        $('#tab_div_nomor_anggota_pabi').val('1');
                                    } 
                                    tgl('.arrow_bag_no_anggota_pabi');
                                    ">
                                    <h6 class="panel-title" style="color:white;">
                                        <input type="hidden" id="tab_div_nomor_anggota_pabi">

                                        <i class="icon-arrow-down12 arrow_bag_no_anggota_pabi" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_no_anggota_pabi" ></i>

                                        <i class="fa fa-credit-card position-left"></i> <strong>NOMOR ANGGOTA PABI</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_no_anggota_pabi">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_nomor_anggota_pabi">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Nomor Anggota -->

                        <!-- START Data Nomor PABI Sejahtera -->
                        <div class="panel panel-primary" style="display: none;">
                            <div class="panel-heading">
                                <a href=".div_bag_no_pabi_sejahtera" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_nomor_pabi_sejahtera').val() == '') {
                                        div_nomor_pabi_sejahtera('{{csrf_token()}}', '#div_nomor_pabi_sejahtera', '{{ $id_member }}');
                                        $('#tab_div_nomor_pabi_sejahtera').val('1');
                                    } 
                                    tgl('.arrow_bag_no_pabi_sejahtera');
                                    ">
                                    <h6 class="panel-title" style="color:white;">
                                        <input type="hidden" id="tab_div_nomor_pabi_sejahtera">

                                        <i class="icon-arrow-down12 arrow_bag_no_pabi_sejahtera" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_no_pabi_sejahtera" ></i>

                                        <i class="fa fa-credit-card position-left"></i> <strong>NOMOR PABI SEJAHTERA</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_no_pabi_sejahtera">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_nomor_pabi_sejahtera">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Nomor PABI Sejahtera -->

                        <!-- START Data Data Periode Poin Member -->
                        <div class="panel panel-primary" style="display: none;">
                            <div class="panel-heading">
                                <a href=".div_bag_periode_poin_member" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_periode_poin_member').val() == '') {
                                        div_periode_poin_member('{{csrf_token()}}', '#div_periode_poin_member', '{{ $id_member }}');
                                        $('#tab_div_periode_poin_member').val('1');
                                    } 
                                    tgl('.arrow_bag_periode_poin_member');
                                    ">
                                    <h6 class="panel-title" style="color:white;">
                                        <input type="hidden" id="tab_div_periode_poin_member">

                                        <i class="icon-arrow-down12 arrow_bag_periode_poin_member" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_periode_poin_member" ></i>

                                        <i class="fa fa-calculator position-left"></i> <strong>DATA PERIODE POIN MEMBER</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_periode_poin_member">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_periode_poin_member">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Data Periode Poin Member -->

                        <!-- START PEKERJAAN -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_3" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_pekerjaan_keanggotaan').val() == '') {
                                        div_pekerjaan_keanggotaan('{{csrf_token()}}', '#div_pekerjaan_keanggotaan', '{{ $id_member }}');
                                        div_tabel_data_pekerjaan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pekerjaan_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_pekerjaan_keanggotaan').val('1');

                                    } 
                                    tgl('.arrow_bag_3');
                                    ">
                                    <h6 class="panel-title" style="color:white">
                                        <input type="hidden" id="tab_div_pekerjaan_keanggotaan">
                                        <i class="icon-arrow-down12 arrow_bag_3" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_3" ></i>
                                        <i class="fa fa-briefcase position-left"></i> <strong>PEKERJAAN</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_3">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_pekerjaan_keanggotaan">

                                        </div>

                                        <div class="col-lg-12" id="div_tabel_data_pekerjaan_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PEKERJAAN -->

                        <!-- START PRAKTEK -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_4" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_praktek_keanggotaan').val() == '') {
                                        div_praktek_keanggotaan('{{csrf_token()}}', '#div_praktek_keanggotaan', '{{ $id_member }}');
                                        div_tabel_data_praktek_keanggotaan('{{csrf_token()}}', '#div_tabel_data_praktek_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_praktek_keanggotaan').val('1');

                                    } 
                                    tgl('.arrow_bag_4');
                                    ">
                                    <h6 class="panel-title" style="color:white">
                                        <input type="hidden" id="tab_div_praktek_keanggotaan">
                                        <i class="icon-arrow-down12 arrow_bag_4" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_4" ></i>
                                        <i class="fa fa-syringe position-left"></i> <strong>PRAKTEK</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_4">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-md-12" id="div_praktek_keanggotaan">

                                        </div>

                                        <div class="col-lg-12" id="div_tabel_data_praktek_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PEKERJAAN -->

                        <!-- START Data Istri / Suami  -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_5" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_data_pasangan_keanggotaan').val() == '') {
                                        div_data_pasangan_keanggotaan('{{csrf_token()}}', '#div_data_pasangan_keanggotaan', '{{ $id_member }}');
                                        div_tabel_data_pasangan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pasangan_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_data_pasangan_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_5');
                                    ">
                                    <h6 class="panel-title" style="color:white">
                                        <input type="hidden" id="tab_div_data_pasangan_keanggotaan">

                                        <i class="icon-arrow-down12 arrow_bag_5" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_5"  ></i>
                                        <i class="icon-heart5 position-left"></i> <strong>DATA ISTRI / SUAMI </strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_5">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_pasangan_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_data_pasangan_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Istri / Suami  -->

                        <!-- START Data Anak  -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_6" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_data_anak_keanggotaan').val() == '') {
                                        div_data_anak_keanggotaan('{{csrf_token()}}', '#div_data_anak_keanggotaan', '{{ $id_member }}');
                                        div_tabel_data_anak_keanggotaan('{{csrf_token()}}', '#div_tabel_data_anak_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_data_anak_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_6');
                                    ">
                                    <h6 class="panel-title" style="color:white" ;>
                                        <input type="hidden" id="tab_div_data_anak_keanggotaan">

                                        <i class="icon-arrow-down12 arrow_bag_6" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_6" ></i> 
                                        <i class="fas fa-baby position-left"></i> <strong>DATA ANAK </strong>
                                    </h6>

                                </a>
                            </div>
                            <div class="collapse div_bag_6">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_anak_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_data_anak_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Anak  -->

                        <!-- START Pendidikan  -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_7" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_data_pendidikan_keanggotaan').val() == '') {
                                        div_data_pendidikan_keanggotaan('{{csrf_token()}}', '#div_data_pendidikan_keanggotaan', '{{ $id_member }}');
                                        div_tabel_data_pendidikan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pendidikan_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_data_pendidikan_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_7');
                                    ">
                                    <h6 class="panel-title" style="color:white">
                                        <input type="hidden" id="tab_div_data_pendidikan_keanggotaan">

                                        <i class="icon-arrow-down12 arrow_bag_7" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_7" ></i>
                                        <i class="fas fa-graduation-cap position-left"></i> <strong>DATA PENDIDIKAN </strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_7">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_pendidikan_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_data_pendidikan_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Pendidikan  -->

                        <!-- START Minat Bidang -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_8" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_minat_bidang_keanggotaan').val() == '') {
                                        div_minat_bidang_keanggotaan('{{csrf_token()}}', '#div_minat_bidang_keanggotaan', '{{ $id_member }}');
                                        div_tabel_minat_bidang_keanggotaan('{{csrf_token()}}', '#div_tabel_minat_bidang_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_minat_bidang_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_8');
                                    ">
                                    <h6 class="panel-title" style="color:white">
                                        <input type="hidden" id="tab_div_minat_bidang_keanggotaan">
                                        <i class="icon-arrow-down12 arrow_bag_8" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_8" ></i>
                                        <i class="fas fa-clinic-medical position-left"></i> <strong>MINAT BIDANG ILMU</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_8">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_minat_bidang_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_minat_bidang_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Minat Bidang -->

                        <!-- START Data Ujian -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_9" class="collapsed" data-toggle="collapse" onclick="
                                    if ($('#tab_div_data_ujian_keanggotaan').val() == '') {
                                        div_data_ujian_keanggotaan('{{csrf_token()}}', '#div_data_ujian_keanggotaan', '{{ $id_member }}');
                                        div_tabel_data_ujian_keanggotaan('{{csrf_token()}}', '#div_tabel_data_ujian_keanggotaan', '{{ $id_member }}');
                                        $('#tab_div_data_ujian_keanggotaan').val('1');
                                    } 
                                    tgl('.arrow_bag_9');
                                    ">
                                    <h6 class="panel-title" style="color:white;">
                                        <input type="hidden" id="tab_div_data_ujian_keanggotaan">
                                        <i class="icon-arrow-down12 arrow_bag_9" style="display: none" ></i>
                                        <i class="icon-arrow-up12 arrow_bag_9" ></i>
                                        <i class="fa fa-chalkboard-teacher position-left"></i> <strong>DATA UJIAN</strong>
                                    </h6>
                                </a>
                            </div>
                            <div class="collapse div_bag_9">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_ujian_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_data_ujian_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Ujian -->

                        <!-- START Data Jurnal -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_10" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_jurnal_keanggotaan').val() == '') {
                                    div_data_jurnal_keanggotaan('{{csrf_token()}}', '#div_data_jurnal_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_jurnal_keanggotaan('{{csrf_token()}}', '#div_tabel_data_jurnal_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_jurnal_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_10');
                                ">
                                <h6 class="panel-title" style="color:white;">
                                    <input type="hidden" id="tab_div_data_jurnal_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_10" style="display: none"></i>
                                    <i class="icon-arrow-up12 arrow_bag_10"></i>
                                    <i class="fa fa-book position-left"></i> <strong>DATA JURNAL</strong>
                                </h6></a>
                            </div>
                            <div class="collapse div_bag_10">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_jurnal_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_data_jurnal_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data Jurnal -->

                        <!-- START Data File -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a href=".div_bag_11" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_file_keanggotaan').val() == '') {
                                    div_data_file_keanggotaan('{{csrf_token()}}', '#div_data_file_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_file_keanggotaan('{{csrf_token()}}', '#div_tabel_data_file_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_file_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_11');
                                ">
                                <h6 class="panel-title" style="color:white;">
                                    <input type="hidden" id="tab_div_data_file_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_11" style="display: none"></i>
                                    <i class="icon-arrow-up12 arrow_bag_11"></i>
                                    <i class="fa fa-file position-left"></i> <strong>DATA FILE</strong>
                                </h6></a>
                            </div>
                            <div class="collapse div_bag_11">
                                <div class="panel-body ">
                                    <div class="row">
                                        <div class="col-lg-12" id="div_data_file_keanggotaan">

                                        </div>
                                        <div class="col-lg-12" id="div_tabel_data_file_keanggotaan">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Data File --> 


                    </div>
                </div>
            </div>
        </div>
        <!-- /Panel Event -->

    </div>

</div>
<!-- /main charts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        div_foto_profile_keanggotaan('{{csrf_token()}}', '#div_foto_profile_keanggotaan', '{{ $id_member }}');
    });
    <?php
    if(isset($message)){
        echo "alertKu('warning', '$message');";
    }
    ?>
</script>

@endsection