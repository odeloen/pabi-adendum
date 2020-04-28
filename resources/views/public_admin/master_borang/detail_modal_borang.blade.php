<form class="form-horizontal" id="formUbahBorangRanahKegiatanPembelajaranPribadi" onsubmit="ubah_kegiatan_pembelajaran_pribadi('{{csrf_token()}}', '#formUbahBorangRanahKegiatanPembelajaranPribadi', '.btn_ubah_kegiatan_pembelajaran_pribadi'); return false;">
    <div class="modal-body">  
        @foreach($data_histori_kegiatan as $key => $val)
            @if($key!='id' && !empty($val)) 
            <div class="form-group">
                <label class="control-label col-sm-4" style="text-align: right;">
                    {{$key}} :
                </label>
                <label class="control-label col-sm-8" style="font-weight: bold">
                    {{$val}} 
             </label> 
         </div>    
            @endif
        @endforeach
    </div>
         
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2(); 
    });
</script>