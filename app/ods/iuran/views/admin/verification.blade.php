@extends('Ods\Core::template.master')
<?php Carbon\Carbon::setLocale('id')?>
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-indigo">
        <h6 class="panel-title">Verifikasi Iuran</h6>
    </div>

    <div class="panel-body">
        <table id="verification_table" class="table datatable-basic table-hover table-bordered">
            <thead>
                <tr>
                    <th><center>Tanggal Pembayaran</center></th>
                    <th style="width:20%;"><center>Tanggal Pembayaran</center></th>
                    <th><center>Nama Dokter</center></th>
                    <th style="width:1%;white-space:nowrap;"><center>Tahun Iuran</center></th>
                    <th class="text-center" style="width:1%;white-space:nowrap;"></th>
                </tr>
            </thead>
            <tbody id="verification_tbody">
                @if (!empty($transactions))
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->receipt_date}}</td>
                            <td>{{$transaction->getReceiptDate()}}</td>
                            {{-- <td>{{Carbon\Carbon::parse($transaction->receipt_date)->format('d F Y')}}</td> --}}
                            <td>{{$transaction->user->fullname}}</td>
                            <td>{{$transaction->tuition->year}}</td>
                            <td class="text-center">
                                <button onclick="onClickDetail({{$transaction->id}})" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_detail"><span>Lihat Detail</span></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div id="modal_detail" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Pembayaran</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 style="color:#4C568A"><strong>Nama Dokter</strong></h6>
                            <div id="verification_fullname">
                                -
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h6 style="color:#4C568A"><strong>Tahun</strong></h6>
                            <div id="verification_tuition_year">
                                -
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h6 style="color:#4C568A"><strong>Nominal</strong></h6>
                            <div id="verification_tuition_amount">
                                -
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12" style="padding-bottom:0;">
                            <h6 style="color:#4C568A"><strong>Detail Transaksi</strong></h6>
                        </div>
                        <div class="col-sm-6">
                            <strong>Dari</strong>
                            <div id="verification_used_account">
                                -<br>
                                -<br>
                                -
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong>Tujuan</strong>
                            <div id="verification_account">
                                -<br>
                                -<br>
                                -
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 style="color:#4C568A"><strong>Bukti Pembayaran</strong></h6>
                            <center><img id="verification_receipt" src="" class="img-responsive" alt="Tidak ada file bukti." width="80%" style="font-style:italic; max-height:250px;width:auto;"></center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.tuition.verification.accept')}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_comment">Tolak</button>
                    <input class="verification_transaction_id" type="hidden" name="transaction_id">
                    <button type="submit" class="btn btn-primary">Terima</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal_comment" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h3 class="modal-title">Alasan Penolakan</h3>
            </div>

            <div class="modal-body">
                <form action="{{route('admin.tuition.verification.decline')}}" method="POST" class="form-horizontal">
                    @csrf
                    <input class="verification_transaction_id" type="hidden" name="transaction_id">
                    <div class="form-group" style="margin-left:1%; margin-right:1%">
						<textarea name="comment" class="form-control" rows="1" id="test" placeholder="Alasan pembayaran ditolak" style="resize:vertical;"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" style="background:#4C568A; color:white;">Simpan</button>
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
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
<script type="text/javascript">
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: true,
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
        "columnDefs":[
            {
                "targets" : [0],
                "visible" : false,
            }
        ],
        "order":[[0,'desc']],
    });
    // END SCRIPT TABEL

    //code for multiple modal overlay
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    //end code for multiple modal overlay

    //code for autoresize textarea
    var ta = document.querySelector('textarea');

    autosize(ta);

    // Dispatch a 'autosize:update' event to trigger a resize:
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:update', true, false);
    ta.dispatchEvent(evt);
    //end code

</script>
<script>
    function formatThousands(bilangan){
        var	reverse = bilangan.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');

        return ribuan
    }
</script>
@if (!empty($transactions))
<script>
    let transactions = {!!$transactions!!}
    let receiptNotFound = "{!!asset('filetidakada.png')!!}"
    function getTransaction(transactionID){

    }

    function onClickDetail(transactionID){
        tarURL = "{{env('APP_URL')}}/iuran/api/transaksi/" + transactionID
        token = "{!!request()->session()->get('pabi_token_api')!!}"

        $.ajax({
            url: tarURL,
            dataType : 'json',
            beforeSend : function(xhr) {
                xhr.setRequestHeader("Authorization", "{{request()->session()->get('pabi_token_api')}}");
            },
            type: "get",
            success: function(response) {
                console.log(response)
                var transaction = response.data.transaction
                if (transaction == null) return;
                setDetailModal(transaction)
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });
    }

    function setDetailModal(transaction){
        console.log(transaction)
        $('#verification_fullname').text(transaction.user.fullname)

        $('#verification_tuition_year').text(transaction.tuition.year)
        $('#verification_tuition_amount').text('Rp.' + formatThousands(transaction.amount))
        $('#verification_used_account').text('')
        $('#verification_used_account').append(
            transaction.account.bank_name + "<br>" + transaction.account.number + "<br>a.n. " + transaction.account.name
        )
        $('.verification_transaction_id').val(transaction.id)
        $('#verification_account').text('')
        $('#verification_account').append(
            transaction.method.accountBankName + "<br>" + transaction.method.account + "<br>a.n. " + transaction.method.accountName
        )
        if (transaction.receipt_path != null){
            $('#verification_receipt').attr('src', '{{env('APP_URL')}}/sl/images/' + transaction.receipt_path)
        } else {
            $('#verification_receipt').attr('src', receiptNotFound)
        }
    }

    $(document).ready(function() {
        var div = $("#verification_tbody")
        var table = $("#verification_table").DataTable()
        console.log(table)
        // transactions.forEach(transaction => {
        //     tarURL = "{{env('APP_URL')}}/user/api/member/" + transaction.user_id
        //     token = "{!!request()->session()->get('pabi_token_api')!!}"

        //     $.ajax({
        //         url: tarURL,
        //         dataType : 'json',
        //         beforeSend : function(xhr) {
        //            xhr.setRequestHeader("Authorization", "{{request()->session()->get('pabi_token_api')}}");
        //         },
        //         type: "get",
        //         success: function(response) {
        //             var member = response.member

        //             var receiptDate = new Date(transaction.receipt_date)

        //             table.row.add([
        //                 transaction.receipt_date,
        //                 receiptDate.getDate() + " " + receiptDate.getMonthName() + " " + receiptDate.getFullYear(),
        //                 member.fullname,
        //                 '<center>'+transaction.tuition.year+'</center>',
        //                 '<center><button onclick="onClickDetail('+transaction.id+')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_detail"><span>Lihat Detail</span></button></center>',
        //             ]).draw()
        //         },
        //         error: function(xhr) {
        //             console.log(xhr)
        //         }
        //     });
        // });
    })

    Date.prototype.monthNames = [
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "August", "September",
        "Oktober", "November", "Desember"
    ];

    Date.prototype.getMonthName = function() {
        return this.monthNames[this.getMonth()];
    };
    Date.prototype.getShortMonthName = function () {
        return this.getMonthName().substr(0, 3);
    };
</script>
@endif
@endsection
