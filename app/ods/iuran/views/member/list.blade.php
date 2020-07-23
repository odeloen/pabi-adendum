@extends('Ods\Core::template.master')
<?php
setlocale(LC_TIME,"id_ID");
Carbon\Carbon::setLocale('id');
?>
@section('addcss')
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{env('ODS_MIDTRANS_CLIENT_KEY')}}"></script>
@endsection
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-indigo">
        <h6 class="panel-title">Iuran Tahunan</h6>
    </div>
    <div class="panel-body">
        <table class="table datatable-basic table-hover table-bordered">
            <thead>
                <tr>
                    <th><center>Tahun</center></th>
                    <th><center>Nominal</center></th>
                    <th><center>Tanggal Pembayaran</center></th>
                    <th><center>Status</center></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($tuitions))
                    @foreach ($tuitions as $tuition)
                    <tr
                    @if ($tuition->transaction == null || $tuition->transaction->inProgress())
                        style="background:#999;color:white" onmouseover="this.style.backgroundColor='#6b6b6b'" onmouseout="this.style.backgroundColor='#999'"

                    @endif
                    >
                        <td><center>{{$tuition->year}}</center></td>
                        <td><center>Rp. {{number_format($tuition->amount, 2, ',', '.')}}</center></td>
                        <td><center>
                            @if ($tuition->onPayment() && $tuition->transaction->receipt_date != null)
                                {{$tuition->transaction->getReceiptDate()}}
                            @else
                                -
                            @endif
                        </center></td>
                        @if (!$tuition->onPayment() || $tuition->transaction->inProgress())
                            <td style="width:1%;white-space:nowrap;"><center><span class="label label-danger">BELUM BAYAR</span><center></td>
                            <td class="text-center">
                                <button onclick="onClickUnpaid({{$tuition->id}})" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_unpaid"> <span>Bayar</span></button>
                            </td>
                        @elseif ($tuition->transaction->inProgress() && !empty($tuition->transaction->receipt_path))
                            <td style="width:1%;white-space:nowrap;"><center><span class="label label-default">MENUNGGU VERIFIKASI</span></center></td>
                            <td class="text-center">
                                <button onclick="onClickProgress({{$tuition->id}})" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_onProcess"><span>Lihat Detail</span></button>
                            </td>
                        @elseif ($tuition->transaction->inProgress())
                            <td style="width:1%;white-space:nowrap;"><center><span class="label label-default">MENUNGGU PEMBAYARAN</span></center></td>
                            <td class="text-center">
                                <button onclick="onClickProgress({{$tuition->id}})" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_onProcess"><span>Lihat Detail</span></button>
                            </td>
                        @elseif ($tuition->transaction->isDone())
                            <td style="width:1%;white-space:nowrap;"><center><span class="label label-primary">LUNAS</span></center></td>
                            <td class="text-center">
                                <button onclick="onClickPaid({{$tuition->id}})" type="button" class="btn" data-toggle="modal" data-target="#modal_paid" style="background:#4C568A; color:white;"><span>Lihat Detail</span></button>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div id="modal_unpaid" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h3 class="modal-title">Bayar Iuran Tahunan</h3>
            </div>

            <div class="modal-body">
                <form action="{{route('member.tuition.pay')}}" method="POST" class="form-horizontal">
                    @csrf
                    <input id="unpaid_tuition_id" type="hidden" name="tuition_id">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Tahun Pembayaran</label>
                        <div class="col-lg-9">
                            <input id="unpaid_year" type="text" class="form-control" readonly="readonly" value="2020">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Nominal</label>
                        <div class="col-lg-9">
                            <input id="unpaid_amount" type="text" class="form-control" readonly="readonly" value="Rp 1.000.000,-">
                        </div>
                    </div>

                    <div class="form-group">
                        <?php $tac = App\Ods\Iuran\Entities\TAC::getInstance() ?>
                        <label class="control-label col-lg-12">
                            <input type="checkbox" class="styled" name="term">
                            Saya telah membaca dan menyetujui <a href="{{env('APP_URL')}}/storage/{{$tac->path}}">Syarat dan Ketentuan</a> dari pembayaran iuran tahunan.
                        </label>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                <button id="pay-button" type="button" class="btn btn-primary" style="background:#4C568A; color:white;">Buat Transaksi</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div id="modal_tac" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h6 class="modal-title">Syarat dan Ketentuan</h6>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Text in a modal</h6>
                <p>Duis mollis, est non commodo luctus, nisi<br> erat porttitor ligula, eget lacinia odio sem. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <hr>

                <h6 class="text-semibold">Another paragraph</h6>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
{{--<div id="modal_onProcess" class="modal fade" tabindex="-1">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" >&times;</button>--}}
{{--                <h3 id="progress_title" class="modal-title"> - </h3>--}}
{{--            </div>--}}

{{--            <div class="modal-body">--}}
{{--                <h6 id="progress_description"> - </h6>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-4"><img src="{{asset('template/images/mandiri.png')}}" class="img-responsive" alt="Mandiri" width="100%"></div>--}}
{{--                    <div class="col-sm-8" style="align-items:center;">--}}
{{--                        <h6>Nomor Rekening</h6>--}}
{{--                        <h4 id="progress_account"> - </h4>--}}
{{--                        <a onclick="copyToClipboard('progress_account')">Salin</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <hr>--}}
{{--                <h6>Nominal</h6>--}}
{{--                <h4 id="progress_amount"> - </h4>--}}
{{--                <a onclick="copyToClipboard('progress_amount')">Salin Jumlah</a>--}}
{{--                <hr>--}}

{{--                <h6> Nomor Rekening Anda </h6>--}}
{{--                <h4 id="progress_used_account"> - </h4>--}}
{{--                <div class="row text-center">--}}
{{--                    <button id="progress_change_method_button" onclick="onClickChangeMethod()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_changeMethod" style="background:#4C568A; color:white;" >Ubah metode</button>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="row text-center">--}}
{{--                    <button id="progress_upload_button" onclick="onClickUpload()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_upload" style="background:#4C568A; color:white;">Upload Bukti</button>--}}
{{--                </div>--}}
{{--                <div class="row text-center" style="margin-top:10px;">--}}
{{--                    <center><img id="progress_receipt" src="" class="img-responsive" alt="Tidak ada file bukti." width="80%" style="font-style:italic; max-height:250px;width:auto;"></center>--}}
{{--                </div>--}}
{{--                <hr class="progress_comment">--}}
{{--                <div class="form-group progress_comment">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <h6 style="color:#4C568A"><strong>Alasan Ditolak</strong></h6>--}}
{{--                            <blockquote style="border-left:10px solid #CB4774; background:#FBE9E7;">--}}
{{--                                <p id="progress_comment"> Bukti terlampir tidak valid </p>--}}
{{--                            </blockquote>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <p> Lihat kembali <a href="{{env('APP_URL')}}/storage/{{$tac->path}}">Syarat dan Ketentuan</a> dari pembayaran iuran tahunan.</p>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modal_changeMethod" class="modal fade" tabindex="-1">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" >&times;</button>--}}
{{--                <h3 class="modal-title">Metode Pembayaran</h3>--}}
{{--            </div>--}}

{{--            <div class="modal-body">--}}
{{--                <form action="{{route('member.tuition.update')}}" method="POST" class="form-horizontal">--}}
{{--                    @csrf--}}
{{--                    <input id="change_transaction" type="hidden" name="transaction_id">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label col-lg-3">Metode Pembayaran</label>--}}
{{--                        <div class=" col-lg-9">--}}
{{--                            <select id="change_payment_method" onchange="onSelectChangePaymentMethod()" name="method_id" class="select" data-placeholder="Pilih Metode Pembayaran" style="border-bottom-color:#009688;">--}}
{{--                                @if (!empty($paymentMethods))--}}
{{--                                    @foreach ($paymentMethods as $paymentMethod)--}}
{{--                                        <option id="{{$paymentMethod->account}}" value="{{$paymentMethod->id}}">{{$paymentMethod->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label class="control-label col-lg-3">Nomor Rekening:</label>--}}
{{--                        <div class="col-lg-9">--}}
{{--                            <input id="change_account" type="text" class="form-control" readonly="readonly" value="2 3 2 13 213 21312321">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label col-lg-3">Rekening yang Digunakan</label>--}}
{{--                        <div class=" col-lg-9">--}}
{{--                            <select id="change_used_account" name="account_id" class="select" data-placeholder="Pilih Nomor Rekening" style="border-bottom-color:#009688;">--}}
{{--                                @if (!empty($accounts))--}}
{{--                                    <?php $j=0?>--}}
{{--                                    @foreach ($accounts as $account)--}}
{{--                                        <option value="{{$j}}">{{$account->bank_name}} - {{$account->number}}</option>--}}
{{--                                        <?php $j++?>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>--}}
{{--                <button type="submit" class="btn btn-primary" style="background:#4C568A; color:white;">Simpan</button>--}}
{{--            </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modal_upload" class="modal fade" tabindex="-1">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" >&times;</button>--}}
{{--                <h3 class="modal-title">Upload Bukti Pembayaran</h3>--}}
{{--            </div>--}}

{{--            <div class="modal-body">--}}
{{--                <form action="{{route('member.tuition.upload')}}" method="POST" class="form-horizontal"  enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <input id="upload_transaction" name="transaction_id" type="hidden">--}}
{{--                    <div class="form-group" style="margin-left:1%; margin-right:1%">--}}
{{--						<div>--}}
{{--                            <center><input name="receipt" type="file" class="file-styled" accept="image/*" id="imgInp" style=" max-height:250px;width:auto;" autocomplete="off"></center>--}}
{{--                            <img id="upload_receipt" src="" alt="" style="width:100%; margin-top:10px;"/>--}}
{{--                        </div>--}}
{{--                        <img id="result" width="100%" style="margin-top:1%;"/>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>--}}
{{--                <button type="submit" class="btn btn-primary" style="background:#4C568A; color:white;">Simpan</button>--}}
{{--            </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div id="modal_paid" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background:#4C568A; color:white;">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h3 class="modal-title">Detail Pembayaran Iuran</h3>
            </div>

            <div class="modal-body">
                <form action="#" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Tahun Pembayaran</label>
                        <div class="col-lg-9">
                            <input id="paid_year" type="text" class="form-control" readonly="readonly" value="2020">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Nominal</label>
                        <div class="col-lg-9">
                            <input id="paid_amount" type="text" class="form-control" readonly="readonly" value="Rp 1.000.000,-">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Metode Pembayaran</label>
                        <div class=" col-lg-9">
                            <input id="paid_method" type="text" class="form-control" readonly="readonly" value="Transfer Virtual Akun">
                            <input id="paid_account" type="text" class="form-control" readonly="readonly" value="2 3 2 13 213 21312321">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Rekening yang Digunakan</label>
                        <div class="col-lg-9">
                            <input id="paid_used_account" type="text" class="form-control" readonly="readonly" value="Mandiri - 2 3 2 13 213 21312321">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Terverifikasi pada</label>
                        <div class="col-lg-9">
                            <input id="paid_verified_timestamp" type="text" class="form-control" readonly="readonly" value="22 Agustus 2019, 18.00 WIB">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
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
        "columnDefs": [
            { "orderable": false, "targets": [0,1,2,3,4] },
        ]
    });
    // END SCRIPT TABEL

    //Fungsi pada Detail Pembayaran Aktif
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#result').attr('src', e.target.result);
                document.getElementById("upload_receipt").style.display = "none";
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
    //END
</script>
<script>
    function formatThousands(bilangan){
        var	reverse = bilangan.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');

        return ribuan
    }

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
</script>
@if (!empty($tuitions))
<script>
        let tuitions = {!!$tuitions!!}
        let accounts = {!!$accounts!!}
        $(document).ready(function(){

        })

        function onClickUnpaid(tuitionID){
            var tuition = getTuition(tuitionID)

            if (tuition == null) return
            setUnpaidModal(tuition)
        }

        function onSelectUnpaidPaymentMethod(){
            var val = $('#unpaid_payment_method').children(':selected').attr('id')

            $('#unpaid_account').val(val)
        }

        function setUnpaidModal(tuition){
            $('#unpaid_tuition_id').val(tuition.id)
            $('#unpaid_year').val(tuition.year)
            $('#unpaid_amount').val('Rp. '+ formatThousands(tuition.amount))
        }

        function onClickProgress(tuitionID){
            var tuition = getTuition(tuitionID)

            if (tuition == null) return
            setProgressModal(tuition)
        }

        let receiptNotFound = "{!!asset('filetidakada.png')!!}"
        function setProgressModal(tuition) {
            $('#progress_title').text('Pembayaran Iuran Tahun ' + tuition.year)
            $('#progress_description').text(tuition.transaction.method.description)
            $('#progress_account').text(tuition.transaction.method.account)
            $('#progress_used_account').text(accounts[0].bank_name + ' - ' + accounts[0].number)
            $('#progress_amount').text('Rp. '+ formatThousands(tuition.amount))
            $('#progress_change_method_button').val(tuition.id)
            $('#progress_upload_button').val(tuition.id)
            $('.progress_comment').hide()
            if (tuition.transaction.comment != null){
                $('#progress_comment').text(tuition.transaction.comment)
                $('.progress_comment').show()
            }
            if (tuition.transaction.receipt_path != null){
                $('#progress_receipt').attr('src', '{{env('APP_URL')}}/sl/images/' + tuition.transaction.receipt_path)
            } else {
                $('#progress_receipt').attr('src', receiptNotFound)
            }
        }

        function onClickChangeMethod(){
            var tuitionID = $('#progress_change_method_button').val()
            var tuition = getTuition(tuitionID)

            if (tuition == null) return
            setChangeMethodModal(tuition)
        }

        function onSelectChangePaymentMethod(){
            var val = $('#change_payment_method').children(':selected').attr('id')

            $('#change_account').val(val)
        }

        function setChangeMethodModal(tuition){
            $('#change_transaction').val(tuition.transaction.id)
            $('#change_payment_method').val(tuition.transaction.method.id)
            $('#select2-change_payment_method-container').text(tuition.transaction.method.name)
            $('#change_account').val(tuition.transaction.method.account)
            $('#change_used_account').val(accounts[0].id)
            $('#select2-change_used_account-container').text(accounts[0].bank_name + ' - ' + accounts[0].number)
        }

        function onClickUpload(){
            var tuitionID = $('#progress_change_method_button').val()
            var tuition = getTuition(tuitionID)

            if (tuition == null) return
            setUploadModal(tuition)
        }

        function setUploadModal(tuition) {
            $('#upload_transaction').val(tuition.transaction.id)
            $('#upload_receipt').attr('src', '')
            if (tuition.transaction.receipt_path != null){
                $('#upload_receipt').attr('src', '{{env('APP_URL')}}/sl/images/' + tuition.transaction.receipt_path)
            }
        }

        function copyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("copy");
            }
        }

        function onClickPaid(tuitionID){
            var tuition = getTuition(tuitionID)

            if (tuition == null) return
            setPaidModal(tuition)
        }

        function setPaidModal(tuition){
            $('#paid_year').val(tuition.year)
            $('#paid_amount').val('Rp. '+ formatThousands(tuition.amount))
            $('#paid_method').val(tuition.transaction.method.name)
            $('#paid_account').val(tuition.transaction.method.account)
            $('#paid_used_account').val(accounts[0].bank_name + ' - ' + accounts[0].number)
            $('#paid_verified_timestamp').val(tuition.transaction.verified_date)
        }

        //code for multiple modal overlay
        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
        //end code for multiple modal overlay

        //code for beautify input
        document.addEventListener('DOMContentLoaded', function() {

            // Default file input style
            $(".file-styled").uniform({
                fileButtonClass: 'action btn btn-default'
            });


            // Primary file input
            $(".file-styled-primary").uniform({
                fileButtonClass: 'action btn bg-blue'
            });

            $('.select').select2({
                minimumResultsForSearch: Infinity
            });
            $(".styled").uniform();
        });
        //end code
    </script>
    <script type="text/javascript">
        var userID = {!! request()->session()->get('pabi_user_id') !!}
        var payButton = document.getElementById('pay-button');

        function ajaxGetToken(tuitionID, callback){
            var snapToken;
            // Request get token to your server & save result to snapToken variable
            $.ajax({
                url: "{{env('APP_URL')}}/iuran/api/member/transaksi/buat",
                beforeSend : function(xhr) {
                    xhr.setRequestHeader("Authorization", "{{request()->session()->get('pabi_token_api')}}");
                },
                method: "post",
                dataType : 'json',
                data : {
                    account_id : userID,
                    tuition_id : tuitionID,
                },
                success: function(response) {
                    var snapToken = response.data.token

                    if(snapToken){
                        callback(null, snapToken);
                    } else {
                        callback(new Error('Failed to fetch snap token'),null);
                    }
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        payButton.addEventListener('click', function () {
            var tuitionID = $('#unpaid_tuition_id').val()

            snap.show();
            ajaxGetToken(tuitionID, function(error, snapToken){
                if(error){
                    snap.hide();
                } else {
                    snap.pay(snapToken);
                }
            });
        });
    </script>
@endif
@endsection
