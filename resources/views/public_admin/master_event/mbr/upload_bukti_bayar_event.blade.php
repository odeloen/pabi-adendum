<div >
    <div >
        <form class="form-horizontal" enctype="multipart/form-data" id="formBuktiPembayaranEvent" onsubmit="
        simpan_form_bukti_pembayaran_event('{{csrf_token()}}', '.btn_simpan_form_bukti_pembayaran_event');
            return false; 
        ">
            <div class="modal-body">
                <div class="form-group">
                    {{ csrf_field() }}
                </div>
                <?php $nominal_total = $data_buku_tamu['nominal_bayar'] + $data_buku_tamu['kode_unik']; ?>
                <input type="hidden" class="form-control" name="nominal_bayar" id="nominal_bayar"
                               value="{{$nominal_total}}" required="" readonly=""> 
                <div class="form-group">
                    <label for="nominal_bayar" style="text-align: right;" class="col-lg-4 control-label">
                        Harga :
                    </label>
                    <div class="col-lg-8 control-label">
                        Rp{{number_format($data_buku_tamu['nominal_bayar'],0,",",".")}} 
                    </div>
                </div>
                <div class="form-group">
                    <label for="nominal_bayar" style="text-align: right;" class="col-lg-4 control-label">
                        Kode Unik :
                    </label>
                    <div class="col-lg-8 control-label">
                        Rp{{number_format($data_buku_tamu['kode_unik'],0,",",".")}} 
                    </div>
                </div>
                <div class="form-group">
                    <label for="nominal_bayar" style="text-align: right;" class="col-lg-4 control-label">
                        Yang Harus Dibayarkan :
                    </label>
                    <div class="col-lg-8 control-label">
                        <b>Rp{{number_format($nominal_total,0,",",".")}}</b> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="tgl_bayar" style="text-align: right;" class="col-lg-4 control-label">
                        Tanggal Pembayaran <span style="color:red"><b>*</b></span> :
                    </label>
                    <div class="col-lg-8">
                        <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control"
                               name="tgl_bayar" id="tgl_bayar" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_bank" style="text-align: right;" class="col-lg-4 control-label">
                        Nama Bank <span style="color:red"><b>*</b></span> :
                    </label>
                    <div class="col-lg-8">
                        <input value="{{$data_member['bank_nama']}}" type="text" class="form-control" name="nama_bank" id="nama_bank" required="">
                    </div>
                </div> 

                <div class="form-group">
                    <label for="nama_pemilik_rekening" style="text-align: right;"
                           class="col-lg-4 control-label">
                        Nama Pemilik Rekening <span style="color:red"><b>*</b></span> :
                    </label>
                    <div class="col-lg-8">
                        <input value="{{$data_member['bank_pemilik']}}" type="text" class="form-control" name="nama_pemilik_rekening" id="nama_pemilik_rekening" required="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nomor_rekening" style="text-align: right;" class="col-lg-4 control-label">
                        No Rekening <span style="color:red"><b>*</b></span> :
                    </label>
                    <div class="col-lg-8">
                        <input value="{{$data_member['bank_no_rekening']}}" type="text" class="form-control" name="nomor_rekening" id="nomor_rekening" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nominal_terbayar" style="text-align: right;" class="col-lg-4 control-label">
                        Nominal Pembayaran <span style="color:red"><b>*</b></span> :
                    </label>
                    <div class="col-lg-8">
                        <input type="number" min="0" class="form-control" name="nominal_terbayar"
                               id="nominal_terbayar" value="" required="" oninput="js_number_format(this.value, '#str_nominal_terbayar')">
                        <span class="help-block">
                            Rp<span id="str_nominal_terbayar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bukti_bayar" style="text-align: right;" class="col-lg-4 control-label">
                        Upload Bukti Pembayaran <span style="color:red"><b>*</b></span> :
                    </label>
                    <div class="col-lg-8">
                        <input type="hidden" name="buku_tamu_id" id="buku_tamu_id"
                               value="{{$data_buku_tamu['id']}}">
                        <input type="file" name="bukti_bayar" id="bukti_bayar" class="file-styled"
                               required="">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i>
                    Batal
                </button>
                <button type="submit"
                        class="btn btn-primary btn-ladda btn_simpan_form_bukti_pembayaran_event"
                        data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
                    <i class="icon-check"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>  
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
    });
</script>