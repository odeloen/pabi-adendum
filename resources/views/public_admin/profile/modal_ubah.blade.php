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
                    <!-- START Foto Profile  -->
                    <div class="row">
                        <div class="col-md-12" id="div_foto_profile_keanggotaan">
                        </div> 
                    </div>  
                    <!-- END Foto Profile  -->

                    <!-- START IDENTITAS DIRI -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <input type="hidden" id="tab_div_identitas_diri_keanggotaan">
                                <a href=".div_bag_1" class="collapsed" data-toggle="collapse" onclick="
                                if ($('#tab_div_identitas_diri_keanggotaan').val() == '') {
                                    div_identitas_diri_keanggotaan('{{csrf_token()}}', '#div_identitas_diri_keanggotaan', '{{ $id_member }}');
                                    $('#tab_div_identitas_diri_keanggotaan').val('1');
                                } 
                                ">
                                    <i class="icon-arrow-down12 arrow_bag_1" style="display: none"
                                       onclick="tgl('.arrow_bag_1')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_1" onclick="tgl('.arrow_bag_1')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>IDENTITAS DIRI</strong>
                            </h6>
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