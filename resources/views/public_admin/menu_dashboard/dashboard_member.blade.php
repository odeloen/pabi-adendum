@extends('public_admin.index')
@section('tempat_content')
@include('public_admin.include.function') 

<?php 
$pabi_borang_proses = request()->session()->get('pabi_borang_proses');

$pabi_event_menunggu_bayar = request()->session()->get('pabi_event_menunggu_bayar');
$pabi_event_akan_datang = request()->session()->get('pabi_event_akan_datang');

$poin_sekarang = request()->session()->get('pabi_poin_setuju_verif');
$min_poin = request()->session()->get('pabi_min_poin');

$pesentase_kredit_poin = 0;
if(!empty($min_poin)){
    $pesentase_kredit_poin = ($poin_sekarang / $min_poin) * 100;
    $pesentase_kredit_poin = round($pesentase_kredit_poin, 2); 
}
?> 
<!-- Main charts -->
<div>
	<div class="row" style="display: none"> 
        <div class="col-sm-12">
            <div class="panel panel-body bg-indigo-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-pulse2 icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">
                            Status Pengajuan
                        </h6>
                        <span class="text-muted"> 
                        </span>
                    </div>
                </div>
                <?php     
                $s_ver_cab = 'Belum Diajukan';
                if (request()->session()->get('pabi_cabang_verif') == 3) {
                    $s_ver_cab = 'Ditolak';
                } else if (request()->session()->get('pabi_cabang_verif') == 2) {
                    $s_ver_cab = 'Disetujui';
                } else if (request()->session()->get('pabi_cabang_verif') == 1) {
                    $s_ver_cab = 'Progress';
                }
                
                $s_ver_pst = 'Belum Diajukan';
                if (request()->session()->get('pabi_pusat_verif') == 3) {
                    $s_ver_pst = 'Ditolak';
                } else if (request()->session()->get('pabi_pusat_verif') == 2) {
                    $s_ver_pst = 'Disetujui';
                } else if (request()->session()->get('pabi_pusat_verif') == 1) {
                    $s_ver_pst = 'Progress';
                } 
                $persentase=0;
                $stat_dashboard="Belum Mengajukan";
                if(request()->session()->get('pabi_cabang_verif') == 1 && request()->session()->get('pabi_pusat_verif') === null){
                    $persentase=40; 
                    $stat_dashboard = "Proses Pengajuan, Menunggu Verifikasi Admin Cabang";
                } else if(request()->session()->get('pabi_cabang_verif') > 1 && request()->session()->get('pabi_pusat_verif') <= 1){ 
                    $persentase=80;  
                    $stat_dashboard = $s_ver_cab." Admin Cabang, Menunggu Verifikasi Admin Pusat";
                } else if(request()->session()->get('pabi_cabang_verif') > 1 && request()->session()->get('pabi_pusat_verif') > 1){  
                    $persentase=100;
                    $stat_dashboard = $s_ver_pst." Admin Pusat ";
                } 
                ?>
                <div class="progress progress-micro mb-10 bg-indigo">
                    <div class="progress-bar bg-white" style="width: <?= $persentase; ?>%">
                        <span class="sr-only"><?= $persentase; ?>% Complete</span>
                    </div>
                </div>
                <span class="pull-right"><?= $persentase; ?>%</span>
                {{ $stat_dashboard }}
            </div>
        </div>
    </div> 
    <div class="row"> 
        <div class="col-sm-6 col-md-3 panelhamdi">
            <div style="height: 200px !important;" class="panel panel-body bg-indigo-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-person icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Status Pengajuan</h6>
                        <span class="text-muted">Keanggotaan</span>
                    </div>
                </div>
                <?php     
                $s_ver_cab = 'Belum Diajukan';
                if (request()->session()->get('pabi_cabang_verif') == 3) {
                    $s_ver_cab = 'Ditolak';
                } else if (request()->session()->get('pabi_cabang_verif') == 2) {
                    $s_ver_cab = 'Disetujui';
                } else if (request()->session()->get('pabi_cabang_verif') == 1) {
                    $s_ver_cab = 'Progress';
                }
                
                $s_ver_pst = 'Belum Diajukan';
                if (request()->session()->get('pabi_pusat_verif') == 3) {
                    $s_ver_pst = 'Ditolak';
                } else if (request()->session()->get('pabi_pusat_verif') == 2) {
                    $s_ver_pst = 'Disetujui';
                } else if (request()->session()->get('pabi_pusat_verif') == 1) {
                    $s_ver_pst = 'Progress';
                } 
                $persentase=0;
                $stat_dashboard="Belum Mengajukan";
                if(request()->session()->get('pabi_cabang_verif') == 1 && request()->session()->get('pabi_pusat_verif') === null){
                    $persentase=40; 
                    $stat_dashboard = "Proses Pengajuan, Menunggu Verifikasi Admin Cabang";
                } else if(request()->session()->get('pabi_cabang_verif') > 1 && request()->session()->get('pabi_pusat_verif') <= 1){ 
                    $persentase=80;  
                    $stat_dashboard = $s_ver_cab." Admin Cabang, Menunggu Verifikasi Admin Pusat";
                } else if(request()->session()->get('pabi_cabang_verif') > 1 && request()->session()->get('pabi_pusat_verif') > 1){  
                    $persentase=100;
                    $stat_dashboard = $s_ver_pst." Admin Pusat ";
                } 
                ?>

                <div class="progress progress-micro mb-10 bg-indigo">
                    <div class="progress-bar bg-white" style="width: <?= $persentase; ?>%">
                        <span class="sr-only"><?= $persentase; ?>% Complete</span>
                    </div>
                </div>
                <span class="pull-right"><?= $persentase; ?>%</span>
                {{ $stat_dashboard }}
                <br>
                <br>
                <br>
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/keanggotaan') }}">
                    Selengkapnya...
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div style="height: 200px !important;" class="panel panel-body bg-blue-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-body">
                        <h6 class="no-margin text-semibold">
                            Kredit Point
                        </h6>
                        <span class="text-muted">
                            s/d <?= tgl_indo(date('Y-m-d')); ?>
                        </span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-book icon-2x"></i>
                    </div>
                </div>
                <div class="progress progress-micro bg-blue mb-10">
                    <div class="progress-bar bg-white" style="width: <?= $pesentase_kredit_poin; ?>%">
                        <span class="sr-only"><?= $pesentase_kredit_poin; ?>% Complete</span>
                    </div>
                </div>
                <span class="pull-right"><?= $pesentase_kredit_poin; ?>%</span>
                <?= $poin_sekarang. '/'.$min_poin; ?>
                <br>
                <br>
                <br>
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/kredit_poin') }}">
                    Selengkapnya...
                </a>
            </div>
        </div> 

        <div class="col-sm-6 col-md-3">
            <div style="height: 200px !important;" class="panel panel-body bg-danger-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-calendar icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Event</h6>
                        <span class="text-muted">Menunggu Bayar / Akan Datang</span>
                    </div>
                </div>  
                <?php
                if(!empty($pabi_event_menunggu_bayar)){
                ?>
                <span class="blink_me"><b><?= $pabi_event_menunggu_bayar; ?></b> Menuggu Bayar </span> & 
                <?php } ?>
                <?= $pabi_event_akan_datang; ?> Akan Datang 
                <br>
                <br>
                <br>
                <?php
                if(!empty($pabi_event_menunggu_bayar)){
                ?>
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/event_saya/belum_bayar') }}">
                    Selengkapnya...
                </a>
                <?php } else {
                ?>
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/event_saya/sudah_bayar') }}">
                    Selengkapnya...
                </a>
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div style="height: 200px !important;" class="panel panel-body bg-warning-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-body">
                        <h6 class="no-margin text-semibold">
                            Borang
                        </h6>
                        <span class="text-muted">
                            s/d <?= tgl_indo(date('Y-m-d')); ?>
                        </span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-book icon-2x"></i>
                    </div>
                </div> 
                <span class="pull-right"></span>
                <br>
                <?= $pabi_borang_proses; ?> Borang Di Proses
                <br>
                <br>
                <br>
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/kredit_poin') }}">
                    Selengkapnya...
                </a>
            </div>
        </div> 
    </div> 
    <?php
    if(!empty($pabi_event_menunggu_bayar)){
    ?>
    <div style="display: none">
        <form class="form-horizontal" enctype="multipart/form-data" id="formFilterMemberEventSaya">
            <?php
            // $date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -90 days");
            $date = date("Y-m-d");

            $date_later = date('Y-m-d', strtotime('+12 months', strtotime(date("Y-m-d"))));
            $date_yesterday = date('Y-m-d', strtotime('-90 days', strtotime(date("Y-m-d"))));
            ?>
            <input type="hidden" class="form-control" value="{{ $date_yesterday }}" name="tgl_event_awal" id="tgl_event_awal">
            <input type="hidden" class="form-control" name="tgl_event_akhir" id="tgl_event_akhir"
            value="{{ $date_later }}"> 
            <input type="hidden" class="form-control" name="limit" id="limit" min="1" value="2">
            <input type="hidden" name="member_id" id="member_id" value="{{session('pabi_member_id')}}">  
        </form>
    </div>
    <div class="panel bg-danger-400">
        <div class="panel-heading">
            <h6 class="panel-title">
                Event Menunggu Bayar
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li> 
                </ul>
            </div>
        </div>

        <div class="panel-body div_event_belum_bayar" style="z-index:1000 !important;">
            loading ...
        </div>
        <div class="panel-footer bg-danger-600 ">
            <a class="heading-elements-toggle" onclick="$('.div_footer_event_event_dashboard').toggle(500);"> 
            <i class="icon-arrow-down12 div_footer_event_event_dashboard" style="display: none" ></i>
            <i class="icon-arrow-up12 div_footer_event_event_dashboard" ></i></a>
            <div class="heading-elements div_footer_event_dashboard" > 
                <div class="btn-group heading pull-right btn-group-velocity">
                    <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/event_saya/belum_bayar') }}">
                        Selengkapnya...
                    </a>
                </div> 
            </div>
        </div> 
    </div>
    <?php } ?>

	<!-- Form horizontal -->
    <div class="panel bg-primary">
        <div class="panel-heading">
            <h6 class="panel-title">
                Data Grafik
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li> 
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 ">
                    <div id="pb_div_grafik_borang_bulan">

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div id="pb_div_grafik_uang_keluar">

                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> 
<script type="text/javascript">

$( document ).ready(function() { 
    div_grafik_borang_bulan('{{csrf_token()}}', '#pb_div_grafik_borang_bulan', '#pb_div_grafik_uang_keluar');
    div_tabel_event_saya_member_div_pendek('{{csrf_token()}}', '.div_event_belum_bayar')
    // div_grafik_barang_keluar('{{csrf_token()}}', '#pb_div_grafik_barang_keluar', '#pb_div_grafik_uang_masuk');

    // var height = $('.panelhamdi').height(); 
    // alert(height);
});
</script>

<script type="text/javascript"> 
</script>
<!-- /main charts -->

@endsection