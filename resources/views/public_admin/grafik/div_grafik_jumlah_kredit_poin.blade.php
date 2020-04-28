<div id="div_grafik_jumlah_kredit_poin">

</div>

<script type="text/javascript">
    Highcharts.chart('div_grafik_jumlah_kredit_poin', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: '10 Kredit Poin Member Teratas'
        },
        subtitle: {
            text: 'Kredit Poin'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Delivered amount',
            data: [
            ['Muchamad Hamdi Ramadhan   ', 43],
            ['Zulfikar Zulfikar ', 32],
            ['Missyahrul Huda', 20],
            ['Prof. R. Syamsuhidayat', 15],
            ['Soerarso Hardjowasito', 23],
            ['Prof. Dr. Paul Tahalele', 10],
            ['Farid Husain', 31],
            ['Usul M. Sinaga', 15],
            ['Tjakra Wibawa Manuaba', 15],
            ['Martopo Marnadi', 14]
            ]
        }]
    });
</script>
