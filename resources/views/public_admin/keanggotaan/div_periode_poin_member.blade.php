@if ($data_periode_poin === null)
<?php
$tgl = date('Y-m-d');
$tahun_periode_awal = date('Y');
$tahun_periode_akhir = date('Y', strtotime('+4 year', strtotime($tgl)));
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formAddDivPeriodePoinMember" onsubmit="add_div_periode_poin_member('{{csrf_token()}}', '.btn_add_div_periode_poin_member'); return false;">
    <div class="form-group">
        {{ csrf_field() }}
        <input type="hidden" name="member_id" id="member_id" value="{{$member_id}}">
    </div> 
    <div class="form-group">
        <label for="tahun_periode_awal" style="text-align: right;" class="col-md-4 control-label">
            Periode Awal <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="tahun_periode_awal" id="tahun_periode_awal" required="" value="{{$tahun_periode_awal}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="tahun_periode_akhir" style="text-align: right;" class="col-md-4 control-label">
            Periode Akhir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="tahun_periode_akhir" id="tahun_periode_akhir" required="" value="{{$tahun_periode_akhir}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="min_poin" style="text-align: right;" class="col-md-4 control-label">
            Minimal Point untuk Periode Saat Ini <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="min_poin" id="min_poin" required="" value="{{$data_periode_poin['min_poin']}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_add_div_periode_poin_member" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan
            </button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.select22').select2();
    });
</script>
@else
<?php
//dd($data_periode_poin); 
$id_borang = $data_periode_poin['id'];
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formDivPeriodePoinMember" onsubmit="simpan_div_periode_poin_member('{{csrf_token()}}', '{{ $id_borang }}', '.btn_simpan_div_periode_poin_member'); return false;">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="tahun_periode_awal" style="text-align: right;" class="col-md-4 control-label">
            Periode Awal <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="tahun_periode_awal" id="tahun_periode_awal" required="" value="{{$data_periode_poin['tahun_periode_awal']}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="tahun_periode_akhir" style="text-align: right;" class="col-md-4 control-label">
            Periode Akhir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="tahun_periode_akhir" id="tahun_periode_akhir" required="" value="{{$data_periode_poin['tahun_periode_akhir']}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="min_poin" style="text-align: right;" class="col-md-4 control-label">
            Minimal Point untuk Periode Saat Ini <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="min_poin" id="min_poin" required="" value="{{$data_periode_poin['min_poin']}}" class="form-control">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-md-4" style="text-align: right;">
            Periode Saat Ini : 
        </label>
        <label class="control-label col-md-7" style="font-weight: bold">
            {{$data_periode_poin['tahun_periode_awal']}}/{{$data_periode_poin['tahun_periode_akhir']}}
        </label> 
    </div> 
    <div class="form-group">
        <label class="control-label col-md-4" style="text-align: right;">
            Point yang Telah Terkumpul untuk Periode Saat Ini : 
        </label>
        <label class="control-label col-md-7" style="font-weight: bold">
            {{$data_periode_poin['poin_setuju_verif']}}
        </label> 
    </div>   
    <div class="form-group">
        <label class="control-label col-md-4" style="text-align: right;">
            Point yang Belum Terverif untuk Periode Saat Ini : 
        </label>
        <label class="control-label col-md-7" style="font-weight: bold">
            {{$data_periode_poin['poin_belum_verif']}}
        </label> 
    </div>   
    <div class="form-group">
        <label class="control-label col-md-4" style="text-align: right;">
            Point yang Ditolak untuk Periode Saat Ini : 
        </label>
        <label class="control-label col-md-7" style="font-weight: bold">
            {{$data_periode_poin['poin_tolak_verif']}}
        </label> 
    </div>   
    <div class="form-group">
        <label class="control-label col-md-4" style="text-align: right;">
            Point Keseluruhan yang telah Diajukan untuk Periode Saat Ini : 
        </label>
        <label class="control-label col-md-7" style="font-weight: bold">
            {{$data_periode_poin['poin_total']}}
        </label> 
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_simpan_div_periode_poin_member" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan
            </button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.select22').select2();
    });
</script>
@endif