@extends('public_admin.index')
@section('tempat_content')

<!-- Main charts -->
<div>
    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Admin Pusat
                <br />
                {{ $data_activity['total_online']['pusat'] }} <b>online</b>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Admin Cabang
                <br />
                {{ $data_activity['total_online']['cabang'] }} <b>online</b>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                Member
                <br />
                {{ $data_activity['total_online']['member'] }} <b>online</b>
            </div>
        </div>
    </div>
	<div class="row"> 
		
        <div class="col-md-6 col-md-3 panelhamdi">
            <div style="height: 250px !important;" class="panel panel-body bg-indigo-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-person icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Member Cabang</h6>
                        <span class="text-muted">Cabang</span>
                    </div>
                </div>  
                 

                <div class="progress progress-micro mb-10 bg-success">
                    <div class="progress-bar bg-white" style="width: 40%">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <span class="pull-right">6</span>
                Belum Diverifikasi
                <br>
                <br>
                <br>
                <br>
                <br>
                <br> 
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/keanggotaan') }}">
                    Selengkapnya...
                </a>
            </div>
        </div>


        <div class="col-md-6 col-md-3">
            <div style="height: 250px !important;" class="panel panel-body bg-danger-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-left media-middle">
                        <i class="icon-calendar icon-2x"></i>
                    </div>

                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Event</h6>
                        <span class="text-muted">Menunggu Bayar / Akan Datang</span>
                    </div>
                </div>   
                <span class="blink_me"><b>4</b> Menuggu Verifikasi Pembayaran </span> 
                <br>
                <br>
                <br>
                <br>
                <br>
                <br> 
                 
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/event_saya/belum_bayar') }}">
                    Selengkapnya...
                </a> 
            </div>
        </div>

        <div class="col-md-6 col-md-3">
            <div style="height: 250px !important;" class="panel panel-body bg-warning-400 has-bg-image">
                <div class="media no-margin-top content-group">
                    <div class="media-body">
                        <h6 class="no-margin text-semibold">
                            Borang
                        </h6>
                        <span class="text-muted"> 
                        </span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-book icon-2x"></i>
                    </div>
                </div> 
                
                <div class="progress progress-micro mb-10 bg-success">
                    <div class="progress-bar bg-white" style="width: 40%"> 
                    </div>
                </div>
                <span class="pull-right">3</span>
                Belum Diverifikasi
                <br>
                <br>
                <br>
                <br>
                <br>
                <br> 
                <br> 
                <a class="no-margin text-semibold" style="color: white" href="{{ url('/member/kredit_poin') }}">
                    Selengkapnya...
                </a>
            </div>
        </div> 

        <div class="col-sm-6 col-md-3 panelhamdi">
            <div style="height: 250px !important;" class="panel panel-body bg-primary">
                <div class="media no-margin-top content-group">
                    <div class="media-body">
                        <h6 class="no-margin text-semibold">Pengajuan perpindahan cabang</h6>
                        <span class="text-muted">Cabang Asal</span>
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-cog3 icon-2x text-primary-400 opacity-75"></i>
                    </div>
                </div>

                <div class="progress progress-micro mb-10">
                    <div class="progress-bar bg-primary-400" style="width: 67%">
                        <span class="sr-only">67% Complete</span>
                    </div>
                </div>
                <span class="pull-right">67%</span>
                Belum Verif

                <br><br>
                <div class="media no-margin-top content-group">
                    <div class="media-body"> 
                        <span class="text-muted">Cabang Tujuan</span>
                    </div> 
                </div>

                <div class="progress progress-micro mb-10">
                    <div class="progress-bar bg-primary-400" style="width: 27%">
                        <span class="sr-only">20% Complete</span>
                    </div>
                </div>
                <span class="pull-right">20%</span>
                Belum Verif
            </div>
        </div> 
		<div style="display: none" class="col-sm-4">
			<div class="panel bg-info">
				<div class="panel-body">
					<div class="heading-elements">
						<!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
					</div> 
					<h3 class="no-margin">
						11
					</h3>
					Jumlah Jurnal
					<div class="text-muted text-size-small">
						&nbsp;
					</div>
				</div>
			</div>
		</div>
		<div style="display: none" class="col-sm-4">
			<div class="panel bg-success">
				<div class="panel-body">
					<div class="heading-elements">
						<!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
					</div>

					<h3 class="no-margin">
						4
					</h3>
					Anak
					<div class="text-muted text-size-small">
						&nbsp;
					</div>
				</div>
			</div>
		</div>
		<div style="display: none" class="col-sm-4">
			<div class="panel bg-pink">
				<div class="panel-body">
					<div class="heading-elements">
						<!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
					</div>

					<h3 class="no-margin">
						2
					</h3>
					Suami
					<div class="text-muted text-size-small">
						&nbsp;
					</div>
				</div>
			</div>
		</div> 
	</div>
	<!-- Form horizontal -->
	
    <div class="panel bg-primary">
        <div class="panel-heading">
            <h6 class="panel-title">
                Data Grafik
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li> 
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 ">
                    <div id="pb_div_grafik_barang_masuk">

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div id="pb_div_grafik_uang_keluar">

                    </div>
                </div>
            </div>
        </div>
    </div> 


    <div class="panel bg-warning">
        <div class="panel-heading">
            <h6 class="panel-title">
                Data Statistik
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li> 
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 ">
                    <div id="pb_div_grafik_borang">

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div id="div_grafik_ranah">

                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> 
</div> 
<script type="text/javascript">

$( document ).ready(function() { 
    div_grafik_barang_masuk('{{csrf_token()}}', '#pb_div_grafik_barang_masuk', '#pb_div_grafik_uang_keluar');
    div_grafik_jumlah_kredit_poin('{{csrf_token()}}', '#pb_div_grafik_uang_keluar');
    div_grafik_borang('{{csrf_token()}}', '#pb_div_grafik_borang');
    div_grafik_ranah('{{csrf_token()}}', '#div_grafik_ranah');

    // div_grafik_barang_keluar('{{csrf_token()}}', '#pb_div_grafik_barang_keluar', '#pb_div_grafik_uang_masuk');
});
</script>

<script type="text/javascript">
	  
    progressPercentage('#progress_percentage_three', 46, 3, "#039BE5", "#fff", 0.69);
    progressPercentage('#progress_percentage_four', 46, 3, "#E53935", "#fff", 0.43);
    progressIcon('#progress_icon_three', 42, 2.5, "#00897B", "#fff", 0.73, "icon-bag");
    // Chart setup
    function progressPercentage(element, radius, border, backgroundColor, foregroundColor, end) {


        // Basic setup
        // ------------------------------

        // Main variables
        var d3Container = d3.select(element),
            startPercent = 0,
            fontSize = 22,
            endPercent = end,
            twoPi = Math.PI * 2,
            formatPercent = d3.format('.0%'),
            boxSize = radius * 2;

        // Values count
        var count = Math.abs((endPercent - startPercent) / 0.01);

        // Values step
        var step = endPercent < startPercent ? -0.01 : 0.01;


        // Create chart
        // ------------------------------

        // Add SVG element
        var container = d3Container.append('svg');

        // Add SVG group
        var svg = container
            .attr('width', boxSize)
            .attr('height', boxSize)
            .append('g')
                .attr('transform', 'translate(' + radius + ',' + radius + ')');


        // Construct chart layout
        // ------------------------------

        // Arc
        var arc = d3.svg.arc()
            .startAngle(0)
            .innerRadius(radius)
            .outerRadius(radius - border)
            .cornerRadius(20);


        //
        // Append chart elements
        //

        // Paths
        // ------------------------------

        // Background path
        svg.append('path')
            .attr('class', 'd3-progress-background')
            .attr('d', arc.endAngle(twoPi))
            .style('fill', backgroundColor);

        // Foreground path
        var foreground = svg.append('path')
            .attr('class', 'd3-progress-foreground')
            .attr('filter', 'url(#blur)')
            .style({
            	'fill': foregroundColor,
            	'stroke': foregroundColor
            });

        // Front path
        var front = svg.append('path')
            .attr('class', 'd3-progress-front')
            .style({
            	'fill': foregroundColor,
            	'fill-opacity': 1
            });


        // Text
        // ------------------------------

        // Percentage text value
        var numberText = svg
            .append('text')
                .attr('dx', 0)
                .attr('dy', (fontSize / 2) - border)
                .style({
                    'font-size': fontSize + 'px',
                    'line-height': 1,
                    'fill': foregroundColor,
                    'text-anchor': 'middle'
                });


        // Animation
        // ------------------------------

        // Animate path
        function updateProgress(progress) {
            foreground.attr('d', arc.endAngle(twoPi * progress));
            front.attr('d', arc.endAngle(twoPi * progress));
            numberText.text(formatPercent(progress));
        }

        // Animate text
        var progress = startPercent;
        (function loops() {
            updateProgress(progress);
            if (count > 0) {
                count--;
                progress += step;
                setTimeout(loops, 10);
            }
        })();
    }

    function progressIcon(element, radius, border, backgroundColor, foregroundColor, end, iconClass) {


        // Basic setup
        // ------------------------------

        // Main variables
        var d3Container = d3.select(element),
            startPercent = 0,
            iconSize = 32,
            endPercent = end,
            twoPi = Math.PI * 2,
            formatPercent = d3.format('.0%'),
            boxSize = radius * 2;

        // Values count
        var count = Math.abs((endPercent - startPercent) / 0.01);

        // Values step
        var step = endPercent < startPercent ? -0.01 : 0.01;


        // Create chart
        // ------------------------------

        // Add SVG element
        var container = d3Container.append('svg');

        // Add SVG group
        var svg = container
            .attr('width', boxSize)
            .attr('height', boxSize)
            .append('g')
                .attr('transform', 'translate(' + (boxSize / 2) + ',' + (boxSize / 2) + ')');


        // Construct chart layout
        // ------------------------------

        // Arc
        var arc = d3.svg.arc()
            .startAngle(0)
            .innerRadius(radius)
            .outerRadius(radius - border)
            .cornerRadius(20);


        //
        // Append chart elements
        //

        // Paths
        // ------------------------------

        // Background path
        svg.append('path')
            .attr('class', 'd3-progress-background')
            .attr('d', arc.endAngle(twoPi))
            .style('fill', backgroundColor);

        // Foreground path
        var foreground = svg.append('path')
            .attr('class', 'd3-progress-foreground')
            .attr('filter', 'url(#blur)')
            .style({
                'fill': foregroundColor,
                'stroke': foregroundColor
            });

        // Front path
        var front = svg.append('path')
            .attr('class', 'd3-progress-front')
            .style({
                'fill': foregroundColor,
                'fill-opacity': 1
            });


        // Text
        // ------------------------------

        // Percentage text value
        var numberText = d3.select('.progress-percentage')
                .attr('class', 'mt-15 mb-5');

        // Icon
        d3.select(element)
            .append("i")
                .attr("class", iconClass + " counter-icon")
                .style({
                    'color': foregroundColor,
                    'top': ((boxSize - iconSize) / 2) + 'px'
                });


        // Animation
        // ------------------------------

        // Animate path
        function updateProgress(progress) {
            foreground.attr('d', arc.endAngle(twoPi * progress));
            front.attr('d', arc.endAngle(twoPi * progress));
            numberText.text(formatPercent(progress));
        }

        // Animate text
        var progress = startPercent;
        (function loops() {
            updateProgress(progress);
            if (count > 0) {
                count--;
                progress += step;
                setTimeout(loops, 10);
            }
        })();
    }
</script>
<!-- /main charts -->

@endsection