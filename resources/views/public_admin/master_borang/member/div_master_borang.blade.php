<?php
$now = (date('Y-m-d'));
$tglsekarang = strtotime(date('Y-m-d'));
$tglterpilih = strtotime($tgl);

$tglminim = strtotime(date("Y-m-d", strtotime($now)) . " -32 days");
// echo $tglminim;
// echo $tglsekarang . ' -- ' . $tglterpilih;

if ($tglterpilih <= $tglsekarang && $tglterpilih >= $tglminim) {
    ?>
    <div>
        <h3>
            Data Borang Tanggal <?= date('d-m-Y', strtotime($tgl)); ?>
        </h3>
        <a class="btn btn-info" onclick="tambah_modal_borang('{{csrf_token()}}', '{{ $tgl }}', '#ModalBiru')">Tambah
            Data <i class="icon-plus3 position-right"></i></a>
    </div>
<?php } else { ?>
    <div>
        <h3>
            Data Borang Tanggal <?= date('d-m-Y', strtotime($tgl)); ?>
        </h3>
        <a class="btn btn-danger" onclick="alertKu('warning', 'Tidak dapat menambah data');">Tambah Data <i
                    class="icon-plus3 position-right"></i></a>
    </div>
<?php } ?>
@include('public_admin.include.function')
<br>
<div class="">
    <table class="table table-bordered table-hover datatable-basic">
        <thead>
        <tr>
            <th width="1%">No</th> 
            <th>Tanggal</th>
            <th>Kegiatan</th>
            <th>Nilai SKP</th>
            <th>Status</th>
            <!-- <th>Status Cabang</th> -->
            <th style="width: 1%">Act</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 0; ?>
        @foreach ($data_kegiatan as $r)
        <?php
        $no++;
        $id = $r['id'];
        $rb_id = $r['ranah_borang_id'];
        //$s_ver_cab = '<span class="label label-flat border-grey text-grey-600">Belum Diajukan</span>';
        $s_ver_cab = '<span class="label label-flat border-primary text-primary-600">Diproses</span>';
        if ($r['cabang_verif'] == 2) {
            $s_ver_cab = '<span class="label label-flat border-danger text-danger-600">Ditolak</span>';
        } else if ($r['cabang_verif'] == 1) {
            $s_ver_cab = '<span class="label label-flat border-success text-success-600">Disetujui</span>';
        }
        // else if ($r['cabang_verif'] == 1) {
        //     $s_ver_cab = '<span class="label label-flat border-primary text-primary-600">Progress</span>';
        // }

        $s_ver_rs = '<span class="label label-flat border-primary text-primary-600">Diproses</span>';
        if ($r['rs_verif'] == 2) {
            $s_ver_rs = '<span class="label label-flat border-danger text-danger-600">Ditolak</span>';
        } else if ($r['rs_verif'] == 1) {
            $s_ver_rs = '<span class="label label-flat border-success text-success-600">Disetujui</span>';
        }

        ?>
        <tr>
            <td>{{ $no }}</td> 
            <td>{!! tgl_indo($r['tgl']) !!}</td> 
            <td>
                <small>
                    @if (!empty($r['rs_id']))
                    Rumah Sakit : <b>{{ $r['rumah_sakit'] }}</b>
                    <br>
                    @endif
                    Ranah : <b>{{ $r['nama_ranah'] }}</b>
                    <br>Jenis : <b>{{ $r['nama_jenis_kegiatan'] }}</b>
                    <br>Keg : <b>{{ $r['nama_kegiatan'] }}</b>
                </small>
            </td>
            <td>{{ $r['nilai_skp'] }}</td> 
            <td>
                <?php
                if (!empty($r['rs_id'])) {
                    echo 'RS : '.$s_ver_cab.'<br><br>';
                }
                echo 'Cabang : '.$s_ver_cab;
                ?>
            </td>
            <td>
                <ul>
                    <li>
                        <button type="button" onclick="
                            detail_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalGreenSm')
                            " id="modal_update_barang" class="btn bg-green-400 btn-xs btn-block">
                            <i class="glyphicon glyphicon-search"></i> Detail Data
                        </button>
                    </li>
                    <?php
                    if($r['cabang_verif'] < 1 
                            || $r['cabang_verif'] === null){
                        ?>
                    <li>
                        <button type="button" onclick="
                            update_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalTeal')
                            " id="modal_update_barang" class="btn bg-indigo-400 btn-xs btn-block">
                            <i class="glyphicon glyphicon-edit"></i> Ubah Data
                        </button>
                    </li>
                    <?php } ?>
                    <li>
                        <button type="button" onclick="
                            upload_modal_borang_file('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalBrown')
                            " id="modal_update_barang" class="btn bg-brown-400 btn-xs btn-block">
                            <i class="glyphicon glyphicon-file"></i> Borang File
                        </button>
                    </li>
                    <?php
                    if($r['cabang_verif'] < 1 
                            || $r['cabang_verif'] === null){
                        ?>
                    <li>
                        <button type="button"
                                onclick="delete_master_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}')"
                                data-toggle="modal" class="btn btn-danger btn-xs btn-block">
                            <i class="glyphicon glyphicon-remove"></i> Hapus Data
                        </button>
                    </li>
                    <?php } ?>
                </ul>
                <!-- <div class="btn-group btn-block btn-group-velocity">
                    <button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i>  <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li>
                            <button type="button" onclick="
                            detail_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalGreenSm')
                            " id="modal_update_barang" class="btn bg-green-400 btn-xs btn-block">
                            <i class="glyphicon glyphicon-search"></i> Detail Data</button> 
                        </li>
                        <li>
                            <button type="button" onclick="
                            update_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalTeal')
                            " id="modal_update_barang" class="btn bg-indigo-400 btn-xs btn-block">
                            <i class="glyphicon glyphicon-edit"></i> Ubah Data</button> 
                        </li> 
                        <li>
                            <button type="button" onclick="
                            upload_modal_borang_file('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalBrown')
                            " id="modal_update_barang" class="btn bg-brown-400 btn-xs btn-block">
                            <i class="glyphicon glyphicon-file"></i> Borang File</button> 
                        </li> 
                        <li>
                            <button type="button" onclick="delete_master_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}')" data-toggle="modal" class="btn btn-danger btn-xs btn-block">
                                <i class="glyphicon glyphicon-remove"></i> Hapus Data
                            </button>
                        </li>
                    </ul>
                </div> -->
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {

        // START SCRIPT TABEL
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: '100px'
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                // searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Menampilkan :</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });
        $('.datatable-basic').DataTable();
        // END SCRIPT TABEL 

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var h = {};

        h = {
            left: 'title',
            center: '',
            right: 'prev,next'
        };
        <?php
        //$aktif=split("-",$tanggal_aktif);
        $hariIni = date("Y-m-d");
        ?> 
        $('#div_calender').fullCalendar({ //re-initialize the calendar
            header: h,
            slotMinutes: 15,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            events: [  
                <?php 
                foreach ($data_pertanggal as $rtgl){
                    $warna = "blue";
                    if($rtgl['judul'] == 'DITOLAK'){
                        $warna = "red";
                    } else if($rtgl['judul'] == 'DISETUJUI'){
                        $warna = "green";
                    }
                    ?> 
                {
                    title: '<?= $rtgl['jumlah']; ?> <?= $rtgl['judul']; ?>',
                    start: '<?= $rtgl['tanggal']; ?>',
                    backgroundColor: ('<?= $warna; ?>'),
                } ,
                <?php } ?>
                {
                    title: 'AKTIF',
                    start: '<?= date('Y-m-d'); ?>',
                    backgroundColor: ('purple'),
                },
                <?php
                $date = $hariIni;
                for($x = 31;$x >= 0;$x--){
                $date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . " -1 days"));
                ?>
                {
                    title: 'AKTIF',
                    start: '{{ $date }}',
                    backgroundColor: ('purple'),
                },
                <?php
                }
                ?>


            ],
            eventClick: function (event) {
                if (event.title) {
                    if(event.title == 'AKTIF' || 1==1){
                        // alert(event.start);
                        // change the day's background color just for fun 
                        $('#div_calender tr td').css('background-color', '');
                        // $(this).css('background-color', '#f2eee5');
                        $('#tgl_calendar').val((event.start).format());
                        $('#btn_tgl_calendar').click();
                    } else {
                        alertKu2('warning', 'Borang', event.title);
                        return false;
                    }
                }
            },
            dayClick: function (date, jsEvent, view) {
                // change the day's background color just for fun 
                $('#div_calender tr td').css('background-color', '');
                $(this).css('background-color', '#f2eee5');
                $('#tgl_calendar').val(date.format());
                $('#btn_tgl_calendar').click();
                // div_master_borang('{{csrf_token()}}', date.format(), '#div_master_borang');

            }
        });
    });

</script>