<?php
$lat = '112.757088';
$lng = '-7.254813';

$lat_dbase = '';
$lng_dbase = '';

if (isset($_GET)) {
    extract($_GET);
}
if (isset($_POST)) {
    extract($_POST);
}
 

if (isset($koordinat)) {
    $koordinat = explode("&&", $koordinat);
    if (sizeof($koordinat) > 1) {
        if (!empty($koordinat[0])) {
            $lat_dbase = $koordinat[0];
            $lng_dbase = $koordinat[1];
            $lat = $koordinat[0];
            $lng = $koordinat[1];
        }
        
    }
}

?>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets_peta/ol.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets_peta/ol.js')}}" type="text/javascript"></script>
    <link href="{{asset('assets_peta/geocoder/ol3-geocoder.css')}}" rel="stylesheet">
    <script src="{{asset('assets_peta/geocoder/ol3-geocoder.js')}}"></script>
    <title>MAPS</title>

    <style>
        .mapss {
            position: relative;
        }

        .ol-popupmaps_gedung {
            /*position: absolute; */
            padding: 15px;
            bottom: -15px;
            left: -35px;
            margin-left: -33px;
            margin-top: -53px;
        }

        .ol-popupmaps_gedung:after, .ol-popupmaps_gedung:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .ol-popupmaps_gedung:after {
            border-top-color: grey;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }
    </style>
</head>
<body>
<img src="{{asset('assets_peta/img/redpin.png')}}" style="display:  none; width: 70px" class="ol-popupmaps_gedung"
     id="pointMapDefault">
<div class="row">
    <div class="col-md-4">
        <div class="radio">
            <label>
                <input type="radio" name="tipemap" class="control-success" checked='1'
                       onclick="set_bing_aerial()">
                Bing Aerial
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="radio">
            <label>
                <input type="radio" name="tipemap" class="control-success" checked='1'
                       onclick="set_bing_road()">
                Bing Road
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="radio">
            <label>
                <input type="radio" name="tipemap" class="control-success" checked='1'
                       onclick="set_osm()">
                Open Street Map
            </label>
        </div>
    </div>
</div>

<div id="mapss" class="mapss" style="width: 100%; height: 100%"></div>
<script type="text/javascript">
    var mode = "default";
    var vectorSource = new ol.source.Vector();
    var vectorLayer = new ol.layer.Vector({
        source: vectorSource
    });
    var sourceBingMaps = new ol.source.BingMaps({
        key: 'AjQ2yJ1-i-j_WMmtyTrjaZz-3WdMb2Leh_mxe9-YBNKk_mz1cjRC7-8ILM7WUVEu',
        imagerySet: 'AerialWithLabels',
        maxZoom: 19
    });
    var sourceBingMaps2 = new ol.source.BingMaps({
        key: 'AjQ2yJ1-i-j_WMmtyTrjaZz-3WdMb2Leh_mxe9-YBNKk_mz1cjRC7-8ILM7WUVEu',
        imagerySet: 'Road',
        maxZoom: 19
    });

    var bing_aerial = new ol.layer.Tile({
        preload: Infinity,
        source: sourceBingMaps,
        crossOrigin: 'anonymous'
    });
    var bing_road = new ol.layer.Tile({
        preload: Infinity,
        source: sourceBingMaps2,
        visible: false,
        crossOrigin: 'anonymous'
    });
    var osm = new ol.layer.Tile({
        source: new ol.source.OSM(),
        visible: false,
        crossOrigin: 'anonymous'
    });


    // START POINT DEFAULT

    var iconBiru = new ol.style.Style({
        image: new ol.style.Icon({
            anchorXUnits: 'fraction',
            anchorYUnits: 'fraction',
            anchor: [0.5, 0.5],
            opacity: 1,
            scale: 0.25,
            src: "{{asset('assets_peta/img/pointbiru.png')}}"
        })
    });
    var iconMerah = new ol.style.Style({
        image: new ol.style.Icon({
            anchorXUnits: 'fraction',
            anchorYUnits: 'fraction',
            anchor: [0.5, 0.5],
            opacity: 1,
            scale: 0.5,
            src: "{{asset('assets_peta/img/redpin.png')}}"
        })
    });

    var formatWKT = new ol.format.WKT();
    var format1 = new ol.format.WKT();
    
    <?php
    if(!empty($lat_dbase)){
    ?>

    var wkt_gedung = 'POINT(<?= $lat; ?> <?= $lng; ?>) ';
    var feature_gedung = formatWKT.readFeature(wkt_gedung, {
        dataProjection: 'EPSG:4326',
        featureProjection: 'EPSG:3857'
    });
    feature_gedung.setProperties({'tipe': 'Gedung', 'id': '', 'nama': ''});
    var point_gedung = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [feature_gedung,]
        }),
        style: [iconBiru]
    });
    
    <?php
    }
    ?>
    var map = new ol.Map({
        target: 'mapss',
        layers: [
            bing_aerial,
            bing_road,
            osm,
            vectorLayer
            <?php
            if (!empty($lat_dbase)) {
                echo ', point_gedung';
            }
            ?>
        ],
        controls: [
            //Define the default controls
            new ol.control.Zoom(),
            new ol.control.Rotate(),
            new ol.control.Attribution(),
            //Define some new controls
            // new ol.control.ZoomSlider(),
            new ol.control.MousePosition(),
            new ol.control.ScaleLine(),
            new ol.control.OverviewMap()
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([<?= $lat; ?>, <?= $lng; ?>]),
            zoom: 11
        })
    });


    function set_bing_aerial() {
        bing_aerial.setVisible(true);
        bing_road.setVisible(false);
        osm.setVisible(false);
    }

    function set_bing_road() {
        bing_aerial.setVisible(false);
        bing_road.setVisible(true);
        osm.setVisible(false);
    }

    function set_osm() {
        bing_aerial.setVisible(false);
        bing_road.setVisible(false);
        osm.setVisible(true);
    }

    function set_lidar() {
        bing_aerial.setVisible(false);
        bing_road.setVisible(false);
        osm.setVisible(false);
    }

    set_osm();


    var pointMap = new ol.Overlay({
        element: document.getElementById("pointMapDefault")
    });
    pointMap.setPosition(ol.proj.fromLonLat([<?= $lat; ?>, <?= $lng; ?>]));
    map.addOverlay(pointMap);

    
    var geocoder = new Geocoder('nominatim', {
        provider: 'osm',
        lang: 'en-US',
        placeholder: 'cari lokasi dari openlayers ',
        targetType: 'text-input',
        limit: 10,
        keepOpen: false,
        preventDefault: false,
        crossOrigin: 'anonymous'
    });
    map.addControl(geocoder);
    geocoder.on('addresschosen', function (evt) {
        var feature = evt.feature,
            coord = evt.coordinate,
            address = evt.address;
        // some popup solution
        // content = document.getElementById('overlay');
        // content.innerHTML = '<p>' + address.formatted + '</p>';
        // overlay.setPosition(coord);
    });


    map.on('singleclick', function (evt) {
        var coordinate = evt.coordinate;
        var latLon = ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
        var xy = latLon.toString().split(",");
        var x = xy[0];
        var y = xy[1];
        // pointMap.setPosition(coordinate);
        info(x, y);
    });

    function info(x, y) {  
    }

    //END WEEK 3
</script>
</body>
</html>


