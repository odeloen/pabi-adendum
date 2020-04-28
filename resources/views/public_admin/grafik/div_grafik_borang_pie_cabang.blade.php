@include('public_admin.include.function')
<?php
$arrbul = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
$arrbulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$arrhari = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu", "Agustus", "September", "Oktober", "November", "Desember");

$pabi_borang_proses = request()->session()->get('pabi_borang_belum_verif_admin_cabang'); 
$pabi_borang_disetujui = request()->session()->get('pabi_borang_setuju_verif_admin_cabang');
$pabi_borang_ditolak = request()->session()->get('pabi_borang_tolak_verif_admin_cabang');

if(empty($pabi_borang_proses)){ $pabi_borang_proses = 0; }
if(empty($pabi_borang_disetujui)){ $pabi_borang_disetujui = 0; }
if(empty($pabi_borang_ditolak)){ $pabi_borang_ditolak = 0; }
?>
<div id="div_grafik_borang">

</div>

<script type="text/javascript">
    // Create the chart
    Highcharts.chart('div_grafik_borang', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Borang'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}'
                }
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: [{
                name: 'Borang Proses',
                y: <?= $pabi_borang_proses; ?>,
                color: "#daf1f9",
                sliced: true,
                selected: true
            },
            {
                name: 'Borang Disetujui',
                y: <?= $pabi_borang_disetujui; ?>,
                color: "#c6f1d6" 
            },
            {
                name: 'Borang Ditolak',
                y: <?= $pabi_borang_ditolak; ?>,
                color: "#f2a6a6" 
            },
            ]
        }]
    });
</script>
