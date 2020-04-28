<!DOCTYPE html>
<html lang="en">
    <head> 
       <title>Invoice</title>
       <style>
           li {
            list-style: none;
            padding: 4px;
           }
       </style>
    </head>
<body>
    <table style="border: 1px solid #ddd; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="280" valign="top">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px;">
                            <img src="http://risetprototipe.tech/assets_member/images/logo.png" class="content-group mt-10" alt="" style="width: 220px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 5px;">
                            <li>{{ $alamat }}</li>
                            <li>{{ $kota }}</li>
                            <li>{{ $telp }}</li>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 5px;">
                            <li><b>Invoice To:</b></li>
                            <li>{{ $firstname }}</li>
                            <li>{{ $alamat_rumah }}</li>
                            <li>{{ $kota_rumah }}</li>  
                            <li>Indonesia</li>   
                            <li>{{ $no_hp }}</li>   
                            <li>{{ $email_pengguna }}</li>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="180" valign="top">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 15px; text-align: right;">
                            <li><b>INVOICE #{{ $dftr_hari }}</b></li>
                            <li>{{ $tgl_buku_tamu }}</li>
                            <li>{{ $tgl_bayar }}</li>
                            <li>{{ $expired_bayar_jam }}</li>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 15px;">
                            <li style="text-align: right;"><b>Payment Details:</b></li>
                            <p><a style="margin: 50px;">Total Due:</a><span style="float: right;">Rp{{ $total_due }}</span></p>
                            <p><a style="margin: 50px;">Bank name:</a><span style="float: right;">Bank Central Asia</span></p>
                            <p><a style="margin: 50px;">Country:</a><span style="float: right;">Indonesia</span></p>
                            <p><a style="margin: 50px;">City:</a><span style="float: right;">{{ $kota_saja }}</span></p>
                            <p><a style="margin: 50px;">Address:</a><span style="float: right;">{{ $alamat }}</span></p>
                            <p><a style="margin: 50px;">No Rekening:</a><span style="float: right;">KFH37784028476740</span></p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        <tr>
            <td width="280" valign="top">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 5px;">
                            <li><b>Description</b></li>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="180" valign="top">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 15px; text-align: right;">
                            <li style="text-align: right;"><b>Total</b></li>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #ddd;">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 5px;">
                            <li><b>{{ $nama_event }}</b></li>
                            <li>{{ $tgl_event }}, {{ $alamat_event }}</li>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="border-top: 1px solid #ddd;">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 15px; text-align: right;">
                            <li><b>{{ $nominal_bayar }}</b></li>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="border-top: 1px solid #ddd;">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 5px;">
                            <li><b>Authorized person</b></li>
                            <li><img src="http://risetprototipe.tech/assets/images/signature.png" class="display-block" style="width: 150px;" alt=""></li>
                            <li>PABI</li>
                            <li>{{ $alamat }}</li>
                            <li>{{ $kota }}</li>
                            <li>{{ $telp }}</li>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="border-top: 1px solid #ddd;">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 15px;">
                            <li style="text-align: right;"><b>Total due</b></li>
                            <p><a style="margin: 50px;">Subtotal:</a><span style="float: right;">Rp{{ $nominal_bayar }}</span></p>
                            <p><a style="margin: 50px;">Kode Unik: (25%)</a><span style="float: right;">Rp{{ $kode_unik }}</span></p>
                            <p><a style="margin: 50px;">Total:</a><span style="float: right; font-size: 16pt;"><b>Rp{{ $nominal_bayar_kode_unik }}</b></span></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="padding: 10px 5px;">
                            <li><b>Informasi Penting</b></li>
                            <li>Silahkan transfer sesuai dengan sub total sampai dengan kode unik 2 angka dibelakang koma, untuk mempermudah dalam verifikasi pembayaran. Terimakasih.</li>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>