@extends('public_admin.index')
@section('tempat_content')
@include('public_admin.include.function')
<?php
$dftr_hari = date('d', strtotime($data_buku_tamu['tgl_member_daftar']));
$dftr_bulan = date('m', strtotime($data_buku_tamu['tgl_member_daftar']));
$dftr_tahun = date('Y', strtotime($data_buku_tamu['tgl_member_daftar']));

$invoice_number = $dftr_hari . '/' . $data_buku_tamu['event_id'] . '.' . $dftr_bulan . '.' . $data_buku_tamu['id'] . '/' . $dftr_tahun;

$expired_bayar = date('Y-m-d', strtotime($data_buku_tamu['expired_bayar']));
$expired_bayar_jam = date('H:00', strtotime($data_buku_tamu['expired_bayar']));
?>
@include('sweet::alert')
<div class="row">

    <div class="col-md-12">
        @if (session()->has('status')) 
        <script type="text/javascript">
            alertKu('success', "{{ session()->get('status') }}");
        </script>
        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert">
                <span>×</span>
                <span class="sr-only">Close</span>
            </button>
            <span class="text-semibold">Berhasil! </span> {{ session()->get('status') }}
            {{session()->forget('status')}}
        </div> 
        @endif
        @if (session()->has('statusT'))
        <div class="alert alert-warning alert-styled-left">
            <button type="button" class="close" data-dismiss="alert">
                <span>×</span>
                <span class="sr-only">Close</span>
            </button>
            <span class="text-semibold">Gagal!<br></span> {{ session()->get('statusT') }}
            {{session()->forget('statusT')}}
        </div>
        @endif
    </div>
</div>
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Invoice</h6>
        <div class="heading-elements">
            @if($data_buku_tamu['status_acc'] != 0)
            <button onclick="upload_bukti_bayar_event('{{csrf_token()}}','{{$data_buku_tamu['id']}}', '#ModalTealSm')"
                    type="button" class="btn bg-teal btn-xs heading-btn"><i class="icon-file-check position-left"></i>
                Verifikasi Pembayaran
            </button>
            @endif
            <button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i>
                Print
            </button>
        </div>
    </div>

    <div class="panel-body no-padding-bottom">
        <div class="row">
            <div class="col-sm-6 content-group">
                <img src="{{ asset('assets_member/images/logo.png') }}" class="content-group mt-10" alt=""
                     style="width: 220px;">
                <ul class="list-condensed list-unstyled">
                    <li>{{ $data_dashboard['alamat'] }}</li>
                    <li>{{ $data_dashboard['kota'] }}, {{ $data_dashboard['provinsi'] }} Indonesia</li>
                    <li>{{ $data_dashboard['no_telp'] }}</li>
                </ul>
            </div>

            <div class="col-sm-6 content-group">
                <div class="invoice-details">
                    <h5 class="text-uppercase text-semibold">Invoice #{{ $invoice_number }}</h5>
                    <ul class="list-condensed list-unstyled">
                        <li>Tanggal Invoice:
                            <span class="text-semibold">
                                                {!! tgl_indo($data_buku_tamu['tgl_member_daftar']) !!}
                                            </span>
                        </li>
                        <li>Bayar Sebelum:
                            <span class="text-semibold">
                                                {!! tgl_indo($expired_bayar) !!} 
                                                <br>{{$expired_bayar_jam}}
                                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-9 content-group">
                <span class="text-muted">Invoice To:</span>
                <ul class="list-condensed list-unstyled">
                    <li><h5>{{ $data_member['firstname'] }} {{ $data_member['lastname'] }}, {{ $data_member['gelar']
                            }}</h5></li>
                    <li><span class="text-semibold">{{ $data_member['alamat_rumah'] }}</span></li>
                    <li>{{ $data_member['nama_kota_kota'] }}</li>
                    <li>Indonesia</li>
                    <li>{{ $data_member['no_telp'] }} - {{ $data_member['no_hp'] }}</li>
                    <li><a href="mailto:{{ $data_member['email'] }}">{{ $data_member['email'] }}</a></li>
                </ul>
            </div>

            <div class="col-md-6 col-lg-3 content-group">
                <span class="text-muted">Payment Details:</span>
                <ul class="list-condensed list-unstyled invoice-payment-details">
                    <li><h5>Total Due: <span class="text-right text-semibold">Rp{{ number_format($data_buku_tamu['nominal_bayar'] + $data_buku_tamu['kode_unik'],0,",",".") }}</span>
                        </h5></li>
                    <li>Bank name: <span class="text-semibold">Bank Central Asia</span></li>
                    <li>Country: <span>Indonesia</span></li>
                    <li>City: <span>{{$data_dashboard['kota'] }}</span></li>
                    <li>Address: <span>{{ $data_dashboard['alamat'] }}</span></li>
                    <li>No Rekening: <span class="text-semibold">KFH37784028476740</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-lg">
            <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="col-sm-2">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <h6 class="no-margin">{{$data_event['nama_event']}}</h6>
                    <span class="text-muted">
                        <i class="icon-calendar text-size-small"></i> &nbsp;{{ tgl_indo($data_event['tgl_event']) }}  &nbsp;
                        <i class="icon-pin text-size-small"></i> &nbsp;{{ $data_event['lokasi_alamat'] }}
                    </span>
                </td>
                <td align="right">
                    <span class="text-semibold">Rp{{ number_format($data_buku_tamu['nominal_bayar'] ,0,",",".") }}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-body">
        <div class="row invoice-payment">
            <div class="col-sm-7">
                <div class="content-group">
                    <h6>Authorized person</h6>
                    <div class="mb-15 mt-15">
                        <img src="{{ asset('assets/images/signature.png')}}" class="display-block" style="width: 150px;"
                             alt="">
                    </div>

                    <ul class="list-condensed list-unstyled text-muted">
                        <li>PABI</li>
                        <li>{{ $data_dashboard['alamat'] }}</li>
                        <li>{{ $data_dashboard['kota'] }}, {{ $data_dashboard['provinsi'] }} Indonesia</li>
                        <li>{{ $data_dashboard['no_telp'] }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="content-group">
                    <h6>Total due</h6>
                    <div class="table-responsive no-border">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">Rp{{ number_format($data_buku_tamu['nominal_bayar'] ,0,",",".")
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <th>Kode Unik: <span class="text-regular">(25%)</span></th>
                                <td class="text-right">Rp{{ number_format( $data_buku_tamu['kode_unik'],0,",",".") }}
                                </td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td class="text-right text-primary"><h5 class="text-semibold">Rp{{
                                        number_format($data_buku_tamu['nominal_bayar'] +
                                        $data_buku_tamu['kode_unik'],0,",",".") }}</h5></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right">
                        <a  href="{{ url('member/send-invoice/'.$buku_tamu_id) }}" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b>
                            Send invoice 
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <h6>Informasi Penting</h6>
        <p class="text-muted">
            Silahkan transfer sesuai dengan sub total sampai dengan kode unik 2 angka dibelakang koma, untuk mempermudah
            dalam verifikasi pembayaran. Terimakasih.
        </p>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
    });
</script>

@endsection