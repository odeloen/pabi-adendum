@extends('Ods\Core::template.master')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading panel-indigo">
        <h6 class="panel-title">Histori Pembayaran Iuran</h6>
    </div>

    <div class="panel-body">
        <table class="table datatable-basic table-hover table-bordered">
            <thead>
                <tr>
                    <th><center>Tanggal Terverifikasi</center></th>
                    <th><center>Nama Dokter</center></th>
                    <th><center>Tahun Iuran</center></th>
                    <th><center>Nominal</center></th>
                    <th><center>Status</center>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($transactions))
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->getVerifiedDate()}}</td>
                            {{-- <td>{{Carbon\Carbon::parse($transaction->verified_date)->formatLocalized('%d %B %Y')}}</td> --}}
                            <td>{{$transaction->user->fullname}}</td>
                            <td style="width:1%;white-space:nowrap;">{{$transaction->tuition->year}}</td>
                            <td><center>Rp. {{number_format($transaction->tuition->amount, 2, ',', '.')}}</center></td>
                            <td><center><span class="label label-success">LUNAS</span></center></td>
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
                            <div id="history_name">
                                Michael Julian
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h6 style="color:#4C568A"><strong>Tahun</strong></h6>
                            <div id="history_year">
                                2019
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h6 style="color:#4C568A"><strong>Nominal</strong></h6>
                            <div id="history_amount">
                                Rp 1.000.000,-
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
                            <div id="history_used_account">
                                Mandiri<br>
                                913821931298<br>
                                a.n Michael Julian
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong>Tujuan</strong>
                            <div id="history_account">
                                Mandiri<br>
                                913821931298<br>
                                a.n Mandiri Virtual Account
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 style="color:#4C568A"><strong>Bukti Pembayaran</strong></h6>
                            <center><img id="history_receipt" src="{{asset('filetidakada.png')}}" class="img-responsive" alt="Tidak ada file bukti." width="80%" style="font-style:italic;"></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
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

    let receiptNotFound = "{!!asset('filetidakada.png')!!}"
    function getTransaction(transactionID){
        var transaction = null
        for (i=0;i<transactions.length;i++){
            if (transactions[i].id == transactionID){
                transaction = transactions[i]
                break
            }
        }
        console.log(transaction)

        return transaction
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
                setModalDetail(transaction)
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });
    }

    function setModalDetail(transaction){
        $('#history_name').text(transaction.user.fullname)
        $('#history_year').text(transaction.tuition.year)
        $('#history_amount').text('Rp.' + formatThousands(transaction.amount))
        $('#history_used_account').text('')
        $('#history_used_account').append(
            transaction.account.bank_name + "<br>" + transaction.account.number + "<br>a.n. " + transaction.account.name
        )
        $('#history_account').text('')
        $('#history_account').append(
            transaction.method.accountBankName + "<br>" + transaction.method.account + "<br>a.n. " + transaction.method.accountName
        )
        if (transaction.receipt_path != null){
            $('#history_receipt').attr('src', '{{env('APP_URL')}}/sl/images/' + transaction.receipt_path)
        } else {
            $('#history_receipt').attr('src', receiptNotFound)
        }
    }
</script>
@endif
@endsection
