<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Daftar Event
                    </a>
                </li> 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form class="form-horizontal" enctype="multipart/form-data" id="formModalDaftarEvent" 
                    onsubmit="
                    simpan_form_modal_daftar_event('{{csrf_token()}}', '.btn_simpan_form_modal_daftar_event');
                    return false; 
                    ">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="event_harga_id" style="text-align: right;" class="col-lg-4 control-label">
                                    Tipe <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7">
                                    <select required="" data-placeholder="Pilih Tipe" class="select22" style="width: 100%" name="event_harga_id" id="event_harga_id" 
                                    onchange="
                                    $('#event_id').val($('#event_harga_id').find('option:selected').attr('event_id'));
                                    $('#harga').val($('#event_harga_id').find('option:selected').attr('harga'));
                                    $('#kuota').val($('#event_harga_id').find('option:selected').attr('kuota'));
                                    $('#kode_unik').val($('#event_harga_id').find('option:selected').attr('kode_unik'));
                                    $('#nominal_bayar').val($('#event_harga_id').find('option:selected').attr('nominal_bayar'));
                                    $('#total').val($('#event_harga_id').find('option:selected').attr('total'));
                                    ">
                                        <option value="">-- Pilih Harga Pendaftaran --</option> 
                                        @foreach ($data_harga as $dh)
                                        <?php
                                        $disabled="";
                                        if($dh['status_harga'] == 2){
                                            $disabled="disabled";
                                        }
                                        $kode_unik = rand(10,99);
                                        $nominal_bayar = $dh['harga'];
                                        $rp = "Rp " . number_format($nominal_bayar,0,',','.');
                                        $total = "Rp " . number_format($nominal_bayar+$kode_unik,0,',','.');
                                        ?>
                                        <option 
                                        {{$disabled}}
                                        value="{{$dh['id']}}" 
                                        kuota="{{$dh['kuota_peserta']}}" 
                                        harga="{{$rp}}" 
                                        event_id="{{$dh['event_id']}}" 
                                        kode_unik="{{$kode_unik}}" 
                                        nominal_bayar="{{$nominal_bayar}}"
                                        total="{{$total}}"
                                        >
                                            {{$dh['kategori']}}
                                        </option> 
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="" name="nominal_bayar" id="nominal_bayar"> 
                                    <input type="hidden" value="" name="event_id" id="event_id">
                                    <?php $member_id = session('pabi_member_id'); ?>
                                    <input type="hidden" value="{{$member_id}}" name="member_id" id="member_id">
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="harga" style="text-align: right;" class="col-lg-4 control-label">
                                    Harga : 
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" class="form-control" name="harga" id="harga" value="">
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="harga" style="text-align: right;" class="col-lg-4 control-label">
                                    Kode Unik : 
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" class="form-control" name="kode_unik" id="kode_unik" value="">
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="harga" style="text-align: right;" class="col-lg-4 control-label">
                                    Total : 
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" class="form-control" name="total" id="total" value="">
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="kuota" style="text-align: right;" class="col-lg-4 control-label">
                                    Kuota : 
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" class="form-control" name="kuota" id="kuota" value="">
                                </div>
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <button type="submit" class="btn btn-primary btn-ladda btn_simpan_form_modal_daftar_event" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
                                <i class="icon-check"></i> Simpan
                            </button> 
                            <input type="hidden" value="{{ url('/member/event_saya/belum_bayar') }}" class="btn_event_saya_belum_bayar"> 
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function () {
        $('.select22').select2();
    });
</script>