<div class="row">
    <div class="col-md-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_data_dokter" data-toggle="tab" aria-expanded="false">
                        Data Dokter
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_data_dokter">  
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
                        <div class="col-md-12" id="div_foto_profile_keanggotaan">
                        </div>
                    </div>
                    <!-- END Foto Profile  -->

                    <!-- START Data IDI -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a href=".div_bag_8" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_idi_keanggotaan').val() == '') {
                                    div_data_idi_keanggotaan('{{csrf_token()}}', '#div_data_idi_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_idi_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_8');
                                ">
                                <h6 class="panel-title" style="color:white;">
                                    <input type="hidden" id="tab_div_data_idi_keanggotaan">

                                    <i class="icon-arrow-down12 arrow_bag_8" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_8" ></i>

                                    <i class="fa fa-user-md position-left"></i> <strong>DATA IDI</strong>
                                </h6>

                            </a>
                        </div>
                        <div class="collapse div_bag_8">
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
                            <a href=".div_bag_1" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_identitas_diri_keanggotaan').val() == '') {
                                    div_identitas_diri_keanggotaan('{{csrf_token()}}', '#div_identitas_diri_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_identitas_diri_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_1');
                                ">
                                <h6 class="panel-title" style="color:white">
                                    <input type="hidden" id="tab_div_identitas_diri_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_1" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_1" ></i>
                                    <i class="fa fa-address-book position-left"></i> <strong>IDENTITAS DIRI</strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_1">
                            <div class="panel-body ">
                                <div class="row">
                                    <div class="col-md-12" id="div_identitas_diri_keanggotaan">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END IDENTITAS DIRI -->

                    <!-- START Data Nomor Anggota -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a href=".div_bag_12" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_nomor_anggota_pabi').val() == '') {
                                    div_nomor_anggota_pabi('{{csrf_token()}}', '#div_nomor_anggota_pabi', '{{ $id_member }}');
                                    $('#tab_div_nomor_anggota_pabi').val('1');
                                } 
                                tgl('.arrow_bag_12');
                                ">
                                <h6 class="panel-title" style="color:white;">
                                    <input type="hidden" id="tab_div_nomor_anggota_pabi">

                                    <i class="icon-arrow-down12 arrow_bag_12" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_12" ></i>

                                    <i class="fa fa-credit-card position-left"></i> <strong>NOMOR ANGGOTA PABI</strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_12">
                            <div class="panel-body ">
                                <div class="row">
                                    <div class="col-md-12" id="div_nomor_anggota_pabi">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Data Nomor Anggota -->

                    <!-- START PEKERJAAN -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a href=".div_bag_10" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_pekerjaan_keanggotaan').val() == '') {
                                    div_pekerjaan_keanggotaan('{{csrf_token()}}', '#div_pekerjaan_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_pekerjaan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pekerjaan_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_pekerjaan_keanggotaan').val('1');

                                } 
                                tgl('.arrow_bag_9');
                                ">
                                <h6 class="panel-title" style="color:white">
                                    <input type="hidden" id="tab_div_pekerjaan_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_9" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_9" ></i>
                                    <i class="fa fa-briefcase position-left"></i> <strong>PEKERJAAN</strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_10">
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
                            <a href=".div_bag_11" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_praktek_keanggotaan').val() == '') {
                                    div_praktek_keanggotaan('{{csrf_token()}}', '#div_praktek_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_praktek_keanggotaan('{{csrf_token()}}', '#div_tabel_data_praktek_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_praktek_keanggotaan').val('1');

                                } 
                                tgl('.arrow_bag_11');
                                ">
                                <h6 class="panel-title" style="color:white">
                                    <input type="hidden" id="tab_div_praktek_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_11" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_11" ></i>
                                    <i class="fa fa-syringe position-left"></i> <strong>PRAKTEK</strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_11">
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
                            <a href=".div_bag_2" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_pasangan_keanggotaan').val() == '') {
                                    div_data_pasangan_keanggotaan('{{csrf_token()}}', '#div_data_pasangan_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_pasangan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pasangan_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_pasangan_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_2');
                                ">
                                <h6 class="panel-title" style="color:white">
                                    <input type="hidden" id="tab_div_data_pasangan_keanggotaan">

                                    <i class="icon-arrow-down12 arrow_bag_2" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_2"  ></i>
                                    <i class="icon-heart5 position-left"></i> <strong>DATA ISTRI / SUAMI </strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_2">
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
                            <a href=".div_bag_3" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_anak_keanggotaan').val() == '') {
                                    div_data_anak_keanggotaan('{{csrf_token()}}', '#div_data_anak_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_anak_keanggotaan('{{csrf_token()}}', '#div_tabel_data_anak_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_anak_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_3');
                                ">
                                <h6 class="panel-title" style="color:white" ;>
                                    <input type="hidden" id="tab_div_data_anak_keanggotaan">

                                    <i class="icon-arrow-down12 arrow_bag_3" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_3" ></i> 
                                    <i class="fas fa-baby position-left"></i> <strong>DATA ANAK </strong>
                                </h6>

                            </a>
                        </div>
                        <div class="collapse div_bag_3">
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
                            <a href=".div_bag_4" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_pendidikan_keanggotaan').val() == '') {
                                    div_data_pendidikan_keanggotaan('{{csrf_token()}}', '#div_data_pendidikan_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_pendidikan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pendidikan_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_pendidikan_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_4');
                                ">
                                <h6 class="panel-title" style="color:white">
                                    <input type="hidden" id="tab_div_data_pendidikan_keanggotaan">

                                    <i class="icon-arrow-down12 arrow_bag_4" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_4" ></i>
                                    <i class="fas fa-graduation-cap position-left"></i> <strong>DATA PENDIDIKAN </strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_4">
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
                            <a href=".div_bag_6" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_minat_bidang_keanggotaan').val() == '') {
                                    div_minat_bidang_keanggotaan('{{csrf_token()}}', '#div_minat_bidang_keanggotaan', '{{ $id_member }}');
                                    div_tabel_minat_bidang_keanggotaan('{{csrf_token()}}', '#div_tabel_minat_bidang_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_minat_bidang_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_6');
                                ">
                                <h6 class="panel-title" style="color:white">
                                    <input type="hidden" id="tab_div_minat_bidang_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_6" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_6" ></i>
                                    <i class="fas fa-clinic-medical position-left"></i> <strong>MINAT BIDANG ILMU</strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_6">
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
                            <a href=".div_bag_7" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_data_ujian_keanggotaan').val() == '') {
                                    div_data_ujian_keanggotaan('{{csrf_token()}}', '#div_data_ujian_keanggotaan', '{{ $id_member }}');
                                    div_tabel_data_ujian_keanggotaan('{{csrf_token()}}', '#div_tabel_data_ujian_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_data_ujian_keanggotaan').val('1');
                                } 
                                tgl('.arrow_bag_7');
                                ">
                                <h6 class="panel-title" style="color:white;">
                                    <input type="hidden" id="tab_div_data_ujian_keanggotaan">
                                    <i class="icon-arrow-down12 arrow_bag_7" style="display: none" ></i>
                                    <i class="icon-arrow-up12 arrow_bag_7" ></i>
                                    <i class="fa fa-chalkboard-teacher position-left"></i> <strong>DATA UJIAN</strong>
                                </h6>
                            </a>
                        </div>
                        <div class="collapse div_bag_7">
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
                            <a href=".div_bag_9" class="collapsed" data-toggle="collapse" onclick="
                            if ($('#tab_div_data_jurnal_keanggotaan').val() == '') {
                                div_data_jurnal_keanggotaan('{{csrf_token()}}', '#div_data_jurnal_keanggotaan', '{{ $id_member }}');
                                div_tabel_data_jurnal_keanggotaan('{{csrf_token()}}', '#div_tabel_data_jurnal_keanggotaan', '{{ $id_member }}');
                                $('#tab_div_data_jurnal_keanggotaan').val('1');
                            } 
                            tgl('.arrow_bag_9');
                            ">
                            <h6 class="panel-title" style="color:white;">
                                <input type="hidden" id="tab_div_data_jurnal_keanggotaan">
                                <i class="icon-arrow-down12 arrow_bag_9" style="display: none"></i>
                                <i class="icon-arrow-up12 arrow_bag_9"></i>
                                <i class="fa fa-book position-left"></i> <strong>DATA JURNAL</strong>
                            </h6></a>
                        </div>
                        <div class="collapse div_bag_9">
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
                            <a href=".div_bag_10" class="collapsed" data-toggle="collapse" onclick="
                            if ($('#tab_div_data_file_keanggotaan').val() == '') {
                                div_data_file_keanggotaan('{{csrf_token()}}', '#div_data_file_keanggotaan', '{{ $id_member }}');
                                div_tabel_data_file_keanggotaan('{{csrf_token()}}', '#div_tabel_data_file_keanggotaan', '{{ $id_member }}');
                                $('#tab_div_data_file_keanggotaan').val('1');
                            } 
                            tgl('.arrow_bag_10');
                            ">
                            <h6 class="panel-title" style="color:white;">
                                <input type="hidden" id="tab_div_data_file_keanggotaan">
                                <i class="icon-arrow-down12 arrow_bag_10" style="display: none"></i>
                                <i class="icon-arrow-up12 arrow_bag_10"></i>
                                <i class="fa fa-file position-left"></i> <strong>DATA FILE</strong>
                            </h6></a>
                        </div>
                        <div class="collapse div_bag_10">
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
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        div_foto_profile_keanggotaan('{{csrf_token()}}', '#div_foto_profile_keanggotaan', '{{ $id_member }}');
    });
</script>