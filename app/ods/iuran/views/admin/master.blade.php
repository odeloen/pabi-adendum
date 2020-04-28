@extends('Ods\Core::template.master')
@section('addcss')
<style>
.dz-details{
    height:100px;
}
</style>
@endsection
@section('content')
<div class="row">
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading panel-indigo">
            <h6 class="panel-title">Terms and Conditions</h6>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="panel panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><i class="icon-file-text2 text-success-400 icon no-edge-top mt-5"></i></a>
                            </div>

                            <div class="media-body">
                                @if (!empty($tac))
                                    <h6 class="media-heading text-semibold"><a href="{{env('APP_URL')}}/storage/{{$tac->path}}" class="text-default">Terms and Conditions</a></h6>
                                @else
                                    <h6 class="media-heading text-semibold"><a href="#" class="text-danger">Belum ada file terms and conditions</a></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary legitRipple" data-toggle="modal" data-target="#modal_updateTAC">Perbarui File</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading panel-indigo">
            <h6 class="panel-title">Master Iuran</h6>
        </div>

        <div class="panel-body">
            <table class="table datatable-basic table-hover table-bordered">
                <thead>
                    <tr>
                        <th><center>Tahun</center></th>
                        <th><center>Nominal</center></th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($tuitions))
                        @foreach ($tuitions as $tuition)
                            <tr>
                                <td>{{$tuition->year}}</td>
                                <td><center>Rp. {{number_format($tuition->amount, 2, ',', '.')}}</center></td>
                                <td class="text-center">
                                    <button onclick="onClickUpdate({{$tuition->id}})" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_update"><span>Ubah</span></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading panel-indigo">
            <h6 class="panel-title">Tambah Data Iuran</h6>
        </div>

        <div class="panel-body">
            <form action="{{route('admin.master.create')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="text" class="form-control" name="yearPicker" id="inputNumber">
                </div>
                <div class="form-group">
                    <label>Nominal</label>
                    <input name="amount" type="text" class="form-control" id="nominal" onkeyup="toRupiah(this)" maxLength="10" onfocus="toRupiah(this)">
                    <span class="help-block" id="inCurrency"></span>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary legitRipple">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div id="modal_update" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{route('admin.master.update')}}" method="post">
                @csrf
                <input id="update_value_id" type="hidden" name="tuition_id">
                <input id="update_value_year" type="hidden" name="year">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ubah Iuran</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 style="color:#4C568A"><strong>Tahun Iuran</strong></h6>
                                <div id="update_year">
                                    2020
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="color:#4C568A">Nominal</label>
                        <input id="update_value_amount" name="amount" type="text" class="form-control" id="nominal" maxLength="10"  onkeyup="toRupiahModal(this)" nfocus="toRupiah(this)" autocomplete="off">
                        <span class="help-block" id="inCurrencyModal"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modal_updateTAC" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Perbaruan Terms and Conditions</h4>
            </div>
            <form action="{{route('admin.tac.update')}}" method="POST"  enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input name="tac" type="file" class="form-control file-styled" id="file" accept="application/pdf">
                        <span class="help-block">File dalam bentuk PDF. File harus berukuran kurang dari 10MB</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script type="text/javascript">
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: true,
            width: '100px'
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari:</span>',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            emptyTable: '<span>Tidak ada data untuk ditampilkan</span>',
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            zeroRecords:"Tidak ditemukan data yang sesuai",
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $('.datatable-basic').DataTable({
        "order":[[0,'desc']],
    });
    // END SCRIPT TABEL

    //code for input form 'tambah/ubah iuran'
    var yearNow=new Date().getFullYear()+1;
    $("input[name='yearPicker']").TouchSpin({
        min: 1945,
        max: 3000,
        step: 1,
        initval: yearNow,
        boosted:5,
        maxboostedstep:10,
    });

    $(document).ready(function () {
        $("input.form-control").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: Ctrl+C
                (e.keyCode == 67 && e.ctrlKey === true) ||
                // Allow: Ctrl+X
                (e.keyCode == 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
            }
        });

    });

    function toRupiah(input){
        var elementValue = input.value;
        document.getElementById("inCurrency").innerHTML = formatRupiah(elementValue, 'Rp. ');
    }
    function toRupiahModal(input){
        var elementValue = input.value;
        document.getElementById("inCurrencyModal").innerHTML = formatRupiah(elementValue, 'Rp. ');
    }
    function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

    //end code

        //code for TAC
        document.addEventListener('DOMContentLoaded', function() {

        // Default file input style
        $(".file-styled").uniform({
            fileButtonClass: 'action btn btn-default'
        });


        // Primary file input
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });

        });
        var uploadField = document.getElementById("file");

        uploadField.onchange = function() {
            if(this.files[0].size > 2*1000000){
                alert("File yang anda upload memiliki ukuran terlalu besar");
                this.value = "";
            };
        };
    //end code
</script>
@if (!empty($tuitions))
<script>
    let tuitions = {!!$tuitions!!}
    function getTuition(tuitionID){
        var tuition = null
        for (i=0;i<tuitions.length;i++){
            if (tuitions[i].id == tuitionID){
                tuition = tuitions[i]
                break
            }
        }
        console.log(tuition)

        return tuition
    }

    function onClickUpdate(tuitionID){
        var tuition = getTuition(tuitionID)

        if (tuition == null) return
        setModalUpdate(tuition)
    }

    function setModalUpdate(tuition){
        $('#update_value_id').val(tuition.id)
        $('#update_value_year').val(tuition.year)
        $('#update_year').text(tuition.year)
        $('#update_value_amount').val(tuition.amount)
    }
</script>
@endif
@endsection
