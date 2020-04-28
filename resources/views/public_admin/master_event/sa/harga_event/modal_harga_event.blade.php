<?php
$id_event = $data_event['id'];
?>
<div class="row">
    <div class="col-lg-12">
        <div class="tabbable"> 
            <div class="tab-content">
                <div class="tab-pane active" id="tab_harga_event"> 
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12" id="div_data_harga_event">
                                
                            </div>
                            <div class="col-lg-12" id="div_tabel_data_harga_event">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
                <div class="tab-pane" id="tab_detail_event"> 

                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        div_data_harga_event('{{csrf_token()}}', '#div_data_harga_event', '{{ $id_event }}', '0');
        div_tabel_data_harga_event('{{csrf_token()}}', '#div_tabel_data_harga_event', '{{ $id_event }}');
    });
</script>