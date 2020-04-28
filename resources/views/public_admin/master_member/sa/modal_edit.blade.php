<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_data_dokter" data-toggle="tab" aria-expanded="false">
                        Data Dokter
                    </a>
                </li>
                @if($data_member['cabang_verif'] != 2 || $data_member['pusat_verif'] != 2)
                @if(session('pabi_role_id') == 1 || session('pabi_role_id') == 3)
                <li>
                    <a href="#tab_cabang_verif" data-toggle="tab" aria-expanded="false">
                        Cabang Verif
                    </a>
                </li>
                @endif
                @if(session('pabi_role_id') == 1 || session('pabi_role_id') == 2)
                <li>
                    <a href="#tab_pusat_verif" data-toggle="tab" aria-expanded="false">
                        Pusat Verif
                    </a>
                </li> 
                @endif
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_data_dokter"> 
                    <!-- START Data IDI -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_8" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_8" style="display: none" onclick="tgl('.arrow_bag_8')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_8" onclick="tgl('.arrow_bag_8')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>DATA IDI</strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_8">
                            <div class="panel-body ">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                {{ csrf_field() }}
                                            </div> 
                                            <div class="form-group">
                                                <label for="admin_cab_id" style="text-align: right;" class="col-lg-4 control-label">
                                                    Admin Cabang <span style="color:red"><b>*</b></span> : 
                                                </label>
                                                <div class="col-lg-7">
                                                    <select data-placeholder="Pilih Admin Cabang" class="select22" name="admin_cab_id" id="admin_cab_id" required="" style="width: 100%" onchange="$('#admin_pst_id').val($('#admin_cab_id').find('option:selected').attr('admpstid'));">
                                                        <option value="" admpstid="">-- Select Admin Cabang--</option> 
                                                        <?php
                                                        foreach ($data_admin_cabang as $dac) {
                                                            $sel_adm_cab = '';
                                                            if ($data_user['admin_cabang_id'] == $dac['id']) {
                                                                $sel_adm_cab = 'selected=""';
                                                            }
                                                            echo '<option value="'.$dac['id'].'" admpstid="'.$dac['admin_pusat_id'].'" '.$sel_adm_cab.'>'.$dac['name'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" name="admin_pst_id" id="admin_pst_id" value="{{ $data_user['admin_pusat_id'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_kerja" style="text-align: right;" class="col-lg-4 control-label">
                                                    Nama Kantor : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="tempat_kerja" id="tempat_kerja" value="{{ $data_member['tempat_kerja'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_kantor" style="text-align: right;" class="col-lg-4 control-label">
                                                    Alamat Kantor : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <textarea readonly name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Lengkap Kantor" class="form-control" rows="4">{{ $data_member['alamat_kantor'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan" style="text-align: right;" class="col-lg-4 control-label">
                                                    Jabatan : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="jabatan" id="jabatan" value="{{ $data_member['jabatan'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_no" style="text-align: right;" class="col-lg-4 control-label">
                                                    Card No : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="card_no" id="card_no" value="{{ $data_member['card_no'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid_until_card_no" style="text-align: right;" class="col-lg-4 control-label">
                                                    Tanggal Validasi Card No : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="date" readonly class="form-control" name="valid_until_card_no" id="valid_until_card_no" value="{{ $data_member['valid_until_card_no'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_pabi_sejahtera" style="text-align: right;" class="col-lg-4 control-label">
                                                    No PABI Sejahtera : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="no_pabi_sejahtera" id="no_pabi_sejahtera" value="{{ $data_member['no_pabi_sejahtera'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_pabi_sejahtera" style="text-align: right;" class="col-lg-4 control-label">
                                                    Tanggal Validasi No PABI Sejahtera : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="date" readonly class="form-control" name="tgl_pabi_sejahtera" id="tgl_pabi_sejahtera" value="{{ $data_member['tgl_pabi_sejahtera'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_str" style="text-align: right;" class="col-lg-4 control-label">
                                                    No STR : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="no_str" id="no_str" value="{{ $data_member['no_str'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sjk_tahun_no_str" style="text-align: right;" class="col-lg-4 control-label">
                                                    Tahun No STR : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="number" class="form-control" name="sjk_tahun_no_str" id="sjk_tahun_no_str" value="{{ $data_member['sjk_tahun_no_str'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan" style="text-align: right;" class="col-lg-4 control-label">
                                                    Keterangan : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <textarea readonly name="keterangan" id="keterangan" placeholder="Alamat Lengkap Kantor" class="form-control" rows="4">{{ $data_member['keterangan'] }}</textarea>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Data IDI -->

                    <!-- START IDENTITAS DIRI -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_1" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_1" style="display: none" onclick="tgl('.arrow_bag_1')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_1" onclick="tgl('.arrow_bag_1')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>IDENTITAS DIRI</strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_1">
                            <div class="panel-body ">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                {{ csrf_field() }}
                                            </div> 
                                            <div class="form-group">
                                                <label for="firstname" style="text-align: right;" class="col-lg-4 control-label">
                                                    Nama Depan : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="firstname" id="firstname" value="{{ $data_member['firstname'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname" style="text-align: right;" class="col-lg-4 control-label">
                                                    Nama Belakang : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="lastname" id="lastname" value="{{ $data_member['lastname'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nickname" style="text-align: right;" class="col-lg-4 control-label">
                                                    Nama Panggilan : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="nickname" id="nickname" value="{{ $data_member['nickname'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gelar" style="text-align: right;" class="col-lg-4 control-label">
                                                    Gelar : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="gelar" id="gelar" value="{{ $data_member['gelar'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_lahir" style="text-align: right;" class="col-lg-4 control-label">
                                                    Tempat Lahir <span style="color:red"><b>*</b></span> : 
                                                </label>
                                                <div class="col-lg-7">
                                                    <select data-placeholder="Pilih Kota Lahir" class="select22" name="tempat_lahir" id="tempat_lahir" required="" style="width: 100%">
                                                        <option value="">-- Select Kota Lahir--</option> 
                                                        @foreach ($data_kota as $dk)
                                                        @if ($data_member['tempat_lahir'] == $dk['id'])
                                                        <option value="{{ $dk['id'] }}" selected="">{{ $dk['nama'] }}</option>
                                                        @endif
                                                        @if($data_member['tempat_lahir'] != $dk['id'])
                                                        <option value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
                                                        @endif 
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="tgl_lahir" style="text-align: right;" class="col-lg-4 control-label">
                                                    Tanggal Lahir : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="date" readonly class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{ $data_member['tgl_lahir'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                @php
                                                $cp = ' checked=""';
                                                $cw = '';
                                                @endphp
                                                @if($data_member['gender'] == 'wanita')
                                                $cp = '';
                                                $cw = ' checked=""';
                                                @endif
                                                <label for="gender" style="text-align: right;" class="col-lg-4 control-label">
                                                    Gender : 
                                                </label>
                                                <div class="col-lg-7">
                                                    <label class="radio-inline">
                                                        <input type="radio" class="styled" name="gender" id="gender" value="pria"{{ $cp }}>
                                                        Pria
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" class="styled" name="gender" id="gender" value="wanita"{{ $cw }}>
                                                        Wanita
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_rumah" style="text-align: right;" class="col-lg-4 control-label">
                                                    Alamat Rumah : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <textarea readonly name="alamat_rumah" id="alamat_rumah" placeholder="Alamat Lengkap Rumah" class="form-control" rows="4">{{ $data_member['alamat_rumah'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_prov" style="text-align: right;" class="col-lg-4 control-label">
                                                    Provinsi <span style="color:red"><b>*</b></span> : 
                                                </label>
                                                <div class="col-lg-7">
                                                    <select data-placeholder="Pilih Provinsi" class="select form-control" name="id_prov" id="id_prov" required="" onchange="set_kota_by_prov('{{csrf_token()}}', '#id_prov', '#kota')">
                                                        <option value="">-- Select Provinsi Tinggal--</option> 
                                                        @foreach ($data_provinsi as $dp)
                                                        @if ($id_prov_member == $dp['id_prov'])
                                                        <option value="{{ $dp['id_prov'] }}" selected="">{{ $dp['nama'] }}</option>
                                                        @endif
                                                        @if($id_prov_member != $dp['id_prov'])
                                                        <option value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
                                                        @endif 
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kota" style="text-align: right;" class="col-lg-4 control-label">
                                                    Kota <span style="color:red"><b>*</b></span> : 
                                                </label>
                                                <div class="col-lg-7">
                                                    <select data-placeholder="Pilih Kota" class="select form-control" name="kota" id="kota" required="">
                                                        @if ($data_member['kota'] !== null)
                                                        <option value="">-- Select Kota Tinggal--</option> 
                                                        @foreach ($kab_by_prov as $dk)
                                                        @if ($data_member['kota'] == $dk['id'])
                                                        <option value="{{ $dk['id'] }}" selected="">{{ $dk['nama'] }}</option>
                                                        @endif
                                                        @if($data_member['kota'] != $dk['id'])
                                                        <option value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
                                                        @endif 
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp" style="text-align: right;" class="col-lg-4 control-label">
                                                    Telepon Aktif : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="no_telp" id="no_telp" value="{{ $data_member['no_telp'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hobi" style="text-align: right;" class="col-lg-4 control-label">
                                                    Hobi : 
                                                </label>
                                                <div class="col-lg-7"> 
                                                    <input type="text" readonly class="form-control" name="hobi" id="hobi" value="{{ $data_member['hobi'] }}">
                                                </div>
                                            </div>
                                            <input type="file" name="image_thumb" style="display: none;">
                                            

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END IDENTITAS DIRI -->

                    <!-- START Data Istri / Suami  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_2" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_2" style="display: none" onclick="tgl('.arrow_bag_2')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_2" onclick="tgl('.arrow_bag_2')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>DATA ISTRI / SUAMI </strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_2">
                            <div class="panel-body ">
                                <div class="row">
                                   

                                    <div class="col-lg-12" style="display: none;"> 
                                        @php 
                                        $id = $data_member['id']; 
                                        @endphp
                                        <div class="form-group">
                                            <div class="col-lg-11"> 
                                                <a style="float: right;" class="btn btn-primary" id="btn_nama_pasangan_filter" onclick="tabel_detail_pasangan('{{csrf_token()}}', '{{ $id }}', '#myprofiledatapasangan');"><i class="icon-check"></i> Simpan</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" id="myprofiledatapasangan">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Nama</th>
                                                    <th>Gender</th>
                                                    <th>Tempat Lahir</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Alamat</th>
                                                    <th>Kota</th>
                                                    <th>Pekerjaan</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1; 
                                                @endphp
                                                @if ($data_pasangan !== null)
                                                @foreach ($data_pasangan as $dps)
                                                <?php $member_pasangan_id = $dps['id']; ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $dps['nama_pasangan'] }}</td>
                                                    <td>{{ $dps['gender'] }}</td>
                                                    <td>{{ $dps['tempat_lahir_pasangan'] }}</td>
                                                    <td>{{ $dps['tgl_lahir_pasangan'] }}</td>
                                                    <td>{{ $dps['alamat_rumah_pasangan'] }}</td>
                                                    <td>{{ $dps['kota_pasangan'] }}</td>
                                                    <td>{{ $dps['pekerjaan_pasangan'] }}</td> 
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Data Istri / Suami  -->

                    <!-- START Data Anak  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_3" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_3" style="display: none" onclick="tgl('.arrow_bag_3')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_3" onclick="tgl('.arrow_bag_3')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>DATA ANAK </strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_3">
                            <div class="panel-body ">
                                <div class="row"> 

                                    <div class="col-lg-12" id="myprofiledataanak">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Nama</th>
                                                    <th>Gender</th>
                                                    <th>Tempat Lahir</th>
                                                    <th>Tanggal Lahir</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1; 
                                                @endphp
                                                @if ($data_anak !== null)
                                                @foreach ($data_anak as $dak)
                                                <?php $member_anak_id = $dak['id']; ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $dak['nama_anak'] }}</td>
                                                    <td>{{ $dak['gender'] }}</td>
                                                    <td>{{ $dak['tempat_lahir_anak'] }}</td>
                                                    <td>{{ $dak['tgl_lahir_anak'] }}</td> 
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Data Anak  -->

                    <!-- START Pendidikan  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_4" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_4" style="display: none" onclick="tgl('.arrow_bag_4')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_4" onclick="tgl('.arrow_bag_4')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>DATA PENDIDIKAN </strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_4">
                            <div class="panel-body ">
                                <div class="row"> 

                                    <div class="col-lg-12" id="myprofiledatapendidikan">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Jenjang Pendidikan</th>
                                                    <th>Jurusan</th>
                                                    <th>Tanggal Lulus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1; 
                                                @endphp
                                                @if ($data_pendidikan !== null)
                                                @foreach ($data_pendidikan as $dpd)
                                                <?php $member_pendidikan_id = $dpd['id']; ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $dpd['jenjang_pendidikan'] }}</td>
                                                    <td>{{ $dpd['jurusan'] }}</td>
                                                    <td>{{ $dpd['tgl_lulus'] }}</td> 
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Pendidikan  -->

                    <!-- START Foto Profile  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_5" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_5" style="display: none" onclick="tgl('.arrow_bag_5')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_5" onclick="tgl('.arrow_bag_5')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>FOTO PROFILE </strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_5">
                            <div class="panel-body ">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div><img src="{{env('URL_API_IP')}}{{$data_member['image_thumb']}}" width="200" height="200"></div>    
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Foto Profile  -->

                    <!-- START Minat Bidang -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_6" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_6" style="display: none" onclick="tgl('.arrow_bag_6')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_6" onclick="tgl('.arrow_bag_6')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>MINAT BIDANG</strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_6">
                            <div class="panel-body ">
                                <div class="row"> 

                                    <div class="col-lg-12" id="myprofiledataminatbidang">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Minat Bidang</th>
                                                    <th>Deskripsi</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1; 
                                                @endphp
                                                @if ($data_minat_bidang !== null)
                                                @foreach ($data_minat_bidang as $dmb)
                                                <?php $member_minat_bidang_id = $dmb['id']; ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $dmb['jenis_minat'] }}</td>
                                                    <td>{{ $dmb['nama'] }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Minat Bidang -->

                    <!-- START Data Ujian -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a href=".div_bag_7" class="collapsed" data-toggle="collapse">
                                    <i class="icon-arrow-down12 arrow_bag_7" style="display: none" onclick="tgl('.arrow_bag_7')"></i>
                                    <i class="icon-arrow-up12 arrow_bag_7" onclick="tgl('.arrow_bag_7')"></i>
                                </a>
                                <i class="icon-book position-left"></i> <strong>DATA UJIAN</strong>
                            </h6>
                        </div>
                        <div class="collapse div_bag_7">
                            <div class="panel-body ">
                                <div class="row"> 

                                    <div class="col-lg-12" id="myprofiledataujian">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Nama Ujian</th>
                                                    <th>Tanggal Lulus</th>
                                                    <th>Tanggal Validasi</th>
                                                    <th>Jenis Ujian</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1; 
                                                @endphp
                                                @if ($data_ujian !== null)
                                                @foreach ($data_ujian as $du)
                                                <?php $member_ujian_id = $du['id']; ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $du['nama_ujian'] }}</td>
                                                    <td>{{ $du['tgl_lulus'] }}</td>
                                                    <td>{{ $du['valid_until'] }}</td>
                                                    <td>{{ $du['jenis'] }}</td>
                                                    
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Data Ujian -->
                </div>
                @if($data_member['cabang_verif'] != 2 || $data_member['pusat_verif'] != 2)
                @if(session('pabi_role_id') == 1 || session('pabi_role_id') == 3)
                <div class="tab-pane" id="tab_cabang_verif">

                    <?php  
                    $member_id = $data_member['id'];
                    $setuju = '';
                    if($data_member['cabang_verif'] != 3){
                        $setuju = 'checked';
                    }
                    $cek_verif_cabang = '';
                    $alert_cabang = '';
                    if ($data_member['cabang_verif'] == 1) {
                        $cek_verif_cabang = 'y';
                        $alert_cabang = '';
                    } else if ($data_member['cabang_verif'] == 2 || $data_member['cabang_verif'] == 3) {
                        $cek_verif_cabang = 't';
                        $alert_cabang = 'Admin Cabang Sudah Melakukan verifikasi';
                    } else {
                        $cek_verif_cabang = 't';
                        $alert_cabang = 'Member ini belum melakukan Pengajuan';
                    }
                    ?>
                    <input type="hidden" name="cek_verif_cabang" id="cek_verif_cabang" value="{{ $cek_verif_cabang }}">
                    <form method="post" action="{{ route('simpan_verifikasi_member_cabang', $member_id) }}" class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#cek_verif_cabang').val() == 'y') { return true; } else { alert('{{ $alert_cabang }}'); return false; }">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Setuju / Tidak Setuju : 
                                </label>
                                <div class="col-lg-7"> 
                                    <div class="onoffswitch">
                                        <input {{ $setuju }} type="checkbox" class="onoffswitch-checkbox"
                                        name="cabang_verif" id="setuju_3">
                                        <label class="onoffswitch-label" for="setuju_3">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Keterangan <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <textarea required="required" name="cabang_ket" id="keterangan_3" placeholder="Keterangan Tambahan" class="form-control summernote" rows="4">{{ $data_member['cabang_ket'] }}</textarea>
                                </div>
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Simpan</button>
                        </div>
                    </form>                    
                </div>
                @endif
                @if(session('pabi_role_id') == 1 || session('pabi_role_id') == 2)
                <div class="tab-pane" id="tab_pusat_verif">

                    <?php  
                    $member_id = $data_member['id'];
                    $setuju = '';
                    if($data_member['pusat_verif'] != 3){
                        $setuju = 'checked';
                    }
                    $cek_verif_pusat = '';
                    $alert_pusat = '';
                    if ($data_member['pusat_verif'] == 1) {
                        if ($data_member['cabang_verif'] == 2 || $data_member['cabang_verif'] == 3) {
                            $cek_verif_pusat = 'y';
                            $alert_pusat = '';
                        } else {
                            $cek_verif_pusat = 't';
                            $alert_pusat = 'Admin Cabang belum melakukan verifikasi, tunggu sampai admin cabang melakukan verifikasi';
                        }
                    } else if ($data_member['pusat_verif'] == 2 || $data_member['pusat_verif'] == 3) {
                        $cek_verif_pusat = 't';
                        $alert_pusat = 'Admin Cabang Sudah Melakukan verifikasi';
                    } else {
                        $cek_verif_pusat = 't';
                        $alert_pusat = 'Member ini belum melakukan Pengajuan';
                    }
                    ?>
                    <input type="hidden" name="cek_verif_pusat" id="cek_verif_pusat" value="{{ $cek_verif_pusat }}">
                    <form method="post" action="{{ route('simpan_verifikasi_member_pusat', $member_id) }}" class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#cek_verif_pusat').val() == 'y') { return true; } else { alert('{{ $alert_pusat }}'); return false; }">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Setuju / Tidak Setuju : 
                                </label>
                                <div class="col-lg-7"> 
                                    <div class="onoffswitch">
                                        <input {{ $setuju }} type="checkbox" class="onoffswitch-checkbox"
                                        name="pusat_verif" id="setuju_3">
                                        <label class="onoffswitch-label" for="setuju_3">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Keterangan <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <textarea required="required" name="pusat_ket" id="keterangan_3" placeholder="Keterangan Tambahan" class="form-control summernote" rows="4">{{ $data_member['pusat_ket'] }}</textarea>
                                </div>
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Simpan</button>
                        </div>
                    </form>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.select22').select2();
    $( document ).ready(function() {
        tabel_detail_pasangan("{{csrf_token()}}", "{{ $data_member['id'] }}", "#myprofiledatapasangan");
    });
</script>