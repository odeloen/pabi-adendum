<div id="div_grafik_barang_masuk">

</div>

<script type="text/javascript">
    Highcharts.chart('div_grafik_barang_masuk', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Jumlah Event Tiap Tahun'
        },
        subtitle: {
            text: 'Jumlah Event'
        },
        xAxis: {
            categories: ['2012', '2013', '2014', '2015', '2016', '2017', '2019', '2020']
        },
        yAxis: {
            title: {
                text: 'Jumlah Event'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [ {
            name: 'Tahun',
            data: [15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8,10]
        }]
    });
</script>
