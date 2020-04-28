<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#ubah_tab_user" data-toggle="tab" aria-expanded="false">
                        Akun
                    </a>
                </li>
                <li class="">
                    <a href="#ubah_tab_member" data-toggle="tab" aria-expanded="true">
                        Data Diri
                    </a>
                </li>
                <li class="">
                    <a href="#ubah_tab_pendidikan" data-toggle="tab" aria-expanded="true">
                        Pendidikian
                    </a>
                </li>
                <li class="">
                    <a href="#ubah_tab_keluarga" data-toggle="tab" aria-expanded="true">
                        Keluarga
                    </a>
                </li>
                <li class="">
                    <a href="#ubah_tab_profile" data-toggle="tab" aria-expanded="true">
                        Foto Profile
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="ubah_tab_user"> 
                    <form method="post" action="#" class="form-horizontal"  >
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div> 
                        <div class="form-group">
                            <label for="username" style="text-align: right;" class="col-lg-4 control-label">
                                Username : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="text" class="form-control" name="username" id="username" required="" value="">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="email" style="text-align: right;" class="col-lg-4 control-label">
                                E-Mail : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="text" class="form-control" name="email" id="email" required="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-11"> 
                                <button style="float: right;" type="submit" class="btn btn-primary"><i class="icon-check"></i> Simpan</button>
                            </div>
                        </div>     
                    </form>
                </div>
                <div class="tab-pane" id="ubah_tab_member">
                    <form method="post" action="#" class="form-horizontal"  >
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div> 
                        <div class="form-group">
                            <label for="firstname" style="text-align: right;" class="col-lg-4 control-label">
                                First Name : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="text" class="form-control" name="firstname" id="firstname" required="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" style="text-align: right;" class="col-lg-4 control-label">
                                Last Name : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="text" class="form-control" name="lastname" id="lastname" required="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gelar" style="text-align: right;" class="col-lg-4 control-label">
                                Gelar : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="text" class="form-control" name="gelar" id="gelar" required="" value="">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="tempat_lahir" style="text-align: right;" class="col-lg-4 control-label">
                                Tempat Lahir : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" style="text-align: right;" class="col-lg-4 control-label">
                                Tanggal Lahir : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" style="text-align: right;" class="col-lg-4 control-label">
                                Gender : 
                            </label>
                            <div class="col-lg-7">
                                <label class="radio-inline">
                                    <div class="choice">
                                        <span class="checked">
                                            <input type="radio" class="styled" name="gender" checked="checked">
                                        </span>
                                    </div>
                                    Pria
                                </label>

                                <label class="radio-inline">
                                    <div class="choice">
                                        <span>
                                            <input type="radio" class="styled" name="gender">
                                        </span>
                                    </div>
                                    Wanita
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="card_no" style="text-align: right;" class="col-lg-4 control-label">
                                Card No : 
                            </label>
                            <div class="col-lg-7"> 
                                <input type="date" class="form-control" name="card_no" id="card_no" required="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-11"> 
                                <button style="float: right;" type="submit" class="btn btn-primary"><i class="icon-check"></i> Simpan</button>
                            </div>
                        </div>     
                    </form>
                </div>
                <div class="tab-pane" id="ubah_tab_pendidikan">

                </div>
                <div class="tab-pane" id="ubah_tab_keluarga">

                </div>
                <div class="tab-pane" id="ubah_tab_profile">
                    <form method="post" action="#" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="tgl_lahir" style="text-align: right;" class="col-lg-4 control-label">
                                Foto Profile : 
                            </label>
                            <div class="col-lg-7">
                                <input type="file" class="file-styled">
                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 control-label"> 
                                <a href="#" style="float: right;" class="btn btn-danger"><i class="icon-trash"></i> Hapus</a>
                            </div>
                            <div class="col-lg-7"> 
                                <button style="float: right;" type="submit" class="btn btn-primary"><i class="icon-check"></i> Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>