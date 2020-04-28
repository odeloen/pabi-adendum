@include('public_admin.include.function') 
<?php
$arrbul = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
$arrbulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<div id="div_grafik_borang_per_bulan">

</div>

<script type="text/javascript">
    // Create the chart
Highcharts.chart('div_grafik_borang_per_bulan', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Jumlah Kredit Point'
    },
    subtitle: {
        text: 'Jumlah 6 Bulan Terakhir'
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
            text: 'Total Point'
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
            name: "Kredit Point",
            colorByPoint: true,
            data: [
                <?php
                $awal = (date('m')*1)-5;
                if($awal < 1){
                    $awal = 1;
                }
                for ($ke=$awal; $ke <= (date('m')*1) ; $ke++) { 
                    $jml=0;
                    for ($i = 1; $i <= count($data_bulan_tahun); $i++){
                        $bulan = $data_bulan_tahun[$i-1];
                        $bulan = substr($bulan,0,strlen($bulan)-5);
                        if($bulan == $arrbulan[$ke]){
                            $jml = $data_member[0]['poin_setuju_verif_'.$i];
                        }
                    }
                    if(empty($jml)){ $jml=0; }

                    ?>
                    {
                        name: "<?= $arrbulan[$ke]; ?>",
                        y: <?= $jml; ?>
                    },
                    <?php 
                }
                ?> 
            ]
        }
    ] 
});
     
</script>
