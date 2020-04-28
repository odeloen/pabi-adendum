@include('public_admin.include.function')
<?php
$arrbul = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
$arrbulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$arrhari = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu", "Agustus", "September", "Oktober", "November", "Desember");

?>
<div id="div_grafik_ranah">

</div>

<script type="text/javascript">
Highcharts.chart('div_grafik_ranah', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Jumlah Borang'
    },
    subtitle: {
        text: 'Jumlah Per Ranah'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Jumlah'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> <br/>'
    },

    series: [
        {
            name: "Borang Per Ranah",
            colorByPoint: true,
            data: [
                <?php
                foreach ($data_grafik_cabang['grafik_borang_per_ranah'] as $r ) {
                    ?>
                    {
                        name: "<?= $r['nama_ranah']; ?>",
                        y: 0<?= $r['jml_q_borang_per_ranah']; ?>
                    },
                    <?php 
                }
                ?> 
            ]
        }
    ] 
});
</script>
