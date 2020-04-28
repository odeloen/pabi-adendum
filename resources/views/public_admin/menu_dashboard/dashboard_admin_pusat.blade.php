@extends('public_admin.index')
@section('tempat_content')

<!-- Main charts -->
<div>
    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Admin Pusat
                <br />
                {{ $data_activity['total_online']['pusat'] }} <b>online</b>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Admin Cabang
                <br />
                {{ $data_activity['total_online']['cabang'] }} <b>online</b>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Member
                <br />
                {{ $data_activity['total_online']['member'] }} <b>online</b>
            </div>
        </div>
    </div>
    <div class="row"> 
        
        <div class="col-md-6 col-md-3 panelhamdi">
            <div style="height: 250px !important;" class="panel panel-body bg-indigo-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-person icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Member Cabang</h6>
                        <span class="text-muted">Cabang</span>
                    </div>
                </div> 
                <br> 
                <?= request()->session()->get('pabi_member_verif_setuju'); ?> Member Disetujui 
                <br>
                <?= request()->session()->get('pabi_member_verif_tolak'); ?> Member Ditolak 
                <br>
                <span class="blink_me"><b><?= request()->session()->get('pabi_member_verif_belum'); ?></b> Member Menuggu Verifikasi </span> 
                <br> 
                <br> 
                <br> 
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/admin/master_member_belum_verif_cabang') }}">
                    Selengkapnya...
                </a>
            </div>
        </div>


        <div class="col-md-6 col-md-3">
            <div style="height: 250px !important;" class="panel panel-body bg-danger-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-calendar icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Event</h6>
                        <span class="text-muted">Menunggu Bayar / Akan Datang</span>
                    </div>
                </div>    
                <?= request()->session()->get('pabi_event_akan_datang_cabang'); ?> Event Akan Datang  
                <br>
                <span class="blink_me"><b><?= request()->session()->get('pabi_event_belum_verif_bayar_cabang'); ?></b> Menuggu Verifikasi Bayar </span> 
                <br>  
                <br>
                <br>
                <br>  
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/event_saya/belum_bayar') }}">
                    Selengkapnya...
                </a> 
            </div>
        </div>

        <div class="col-md-6 col-md-3">
            <div style="height: 250px !important;" class="panel panel-body bg-warning-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-body">
                        <h6 class="no-margin text-semibold">
                            Borang
                        </h6>
                        <span class="text-muted"> 
                            Kredit Poin
                        </span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-book icon-2x"></i>
                    </div>
                </div> 
                <br>
                <span class="blink_me"><b><?= request()->session()->get('pabi_borang_belum_verif_admin_cabang'); ?></b> Menuggu Verifikasi Borang </span> 
                <br>
                <br>
                <br> 
                <br>  
                <br>  
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/kredit_poin') }}">
                    Selengkapnya...
                </a>
            </div>
        </div> 

        <div class="col-sm-6 col-md-3 panelhamdi">
            <div style="height: 250px !important;" class="panel panel-body bg-blue-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Pengajuan perpindahan cabang</h6>
                        <span class="text-muted">Cabang Asal</span>
                        <br>
                        <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_asal_belum_verif'); ?></span>
                        Belum Diverif
                        <br>
                        <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_asal_sudah_verif'); ?></span>
                        Sudah Diverif
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-cog3 icon-2x text-primary-400 opacity-75"></i>
                    </div>
                </div>

                <div class="progress progress-micro mb-10 bg-primary" style="display: none;">
                    <div class="progress-bar bg-white" style="width: 67%">
                        <span class="sr-only">67% Complete</span>
                    </div>
                </div>
                <!-- <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_asal_belum_verif'); ?></span>
                Belum Diverif<br>
                <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_asal_sudah_verif'); ?></span>
                Sudah Diverif -->

                <div class="media no-margin-top content-group">
                    <div class="media-body"> 
                        <span class="text-muted">Cabang Tujuan</span>
                        <br>
                        <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_tujuan_belum_verif'); ?></span>
                        Belum Diverif
                        <br>
                        <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_tujuan_sudah_verif'); ?></span>
                        Sudah Diverif
                    </div> 
                </div>

                <div class="progress progress-micro mb-10 bg-primary" style="display: none;">
                    <div class="progress-bar bg-white" style="width: 20%">
                        <span class="sr-only">67% Complete</span>
                    </div>
                </div>
                <!-- <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_tujuan_belum_verif'); ?></span>
                Belum Diverif<br>
                <span class="pull-right"><?= request()->session()->get('pabi_pindah_cabang_tujuan_sudah_verif'); ?></span>
                Sudah Diverif -->
            </div>
        </div> 
        <div style="display: none" class="col-sm-4">
            <div class="panel bg-info">
                <div class="panel-body">
                    <div class="heading-elements">
                        <!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
                    </div> 
                    <h3 class="no-margin">
                        11
                    </h3>
                    Jumlah Jurnal
                    <div class="text-muted text-size-small">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none" class="col-sm-4">
            <div class="panel bg-success">
                <div class="panel-body">
                    <div class="heading-elements">
                        <!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
                    </div>

                    <h3 class="no-margin">
                        4
                    </h3>
                    Anak
                    <div class="text-muted text-size-small">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none" class="col-sm-4">
            <div class="panel bg-pink">
                <div class="panel-body">
                    <div class="heading-elements">
                        <!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
                    </div>

                    <h3 class="no-margin">
                        2
                    </h3>
                    Suami
                    <div class="text-muted text-size-small">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div> 
    </div>
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
                    <div id="pb_div_grafik_barang_masuk">

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div id="pb_div_grafik_uang_keluar">

                    </div>
                </div>
            </div>
        </div>
    </div> 


    <div class="panel bg-warning">
        <div class="panel-heading">
            <h6 class="panel-title">
                Data Statistik
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
                    <div id="pb_div_grafik_borang">

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div id="div_grafik_ranah">

                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> 
</div> 
<script type="text/javascript">

$( document ).ready(function() { 
    div_grafik_barang_masuk('{{csrf_token()}}', '#pb_div_grafik_barang_masuk', '#pb_div_grafik_uang_keluar');
    div_grafik_jumlah_kredit_poin('{{csrf_token()}}', '#pb_div_grafik_uang_keluar');
    div_grafik_borang('{{csrf_token()}}', '#pb_div_grafik_borang');
    div_grafik_ranah('{{csrf_token()}}', '#div_grafik_ranah');

    // div_grafik_barang_keluar('{{csrf_token()}}', '#pb_div_grafik_barang_keluar', '#pb_div_grafik_uang_masuk');
});
</script> 
<!-- /main charts -->

@endsection