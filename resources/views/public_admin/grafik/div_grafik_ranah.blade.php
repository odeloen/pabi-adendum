<div id="div_grafik_ranah">

</div>

<script type="text/javascript">
    Highcharts.chart('div_grafik_ranah', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'Jumlah Borang Per Ranah'
        },

        xAxis: {
            categories: ['Profresional', 'Pembelajaran Pribadi', 'Pengabdian Masyarakat', 'Publikasi Ilmiah', 'Pengembangan Ilmu dan Pendidikan']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of fruits'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: [{
            name: 'Ranah',
            data: [5, 3, 4, 7, 2],
            stack: 'male'
        }]
    });
</script>
