<!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
	crossorigin=""></script>

	<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
	<script src="assets/js/leaflet.ajax.js"></script>


	<link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.css" />
	<link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.Default.css" />
	<script src="assets/js/Leaflet.markercluster-master/dist/leaflet.markercluster-src.js"></script>

   	<script type="text/javascript">

   	var map = L.map('mapid').setView([-3.824181, 114.8191513], 9);

   	var LayerKita=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
});
	map.addLayer(LayerKita);

	var myStyle2 = {
	    "color": "#ffff00",
	    "weight": 1,
	    "opacity": 0.9
	};

	function popUp(f,l){
	    var out = [];
	    if (f.properties){
	        // for(key in f.properties){
	        // 	console.log(key);

	        // }
			out.push("Provinsi: "+f.properties['PROVINSI']);
			out.push("Kecamatan: "+f.properties['KECAMATAN']);
	        l.bindPopup(out.join("<br />"));
	    }
	}

	// legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
	}

	function featureToMarker(feature, latlng) {
		return L.marker(latlng, {
			icon: L.divIcon({
				className: 'marker-'+feature.properties.amenity,
				html: iconByName(feature.properties.amenity),
				iconUrl: '../images/markers/'+feature.properties.amenity+'.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
		});
	}

	var baseLayers = [
		{
			name: "OpenStreetMap",
			layer: LayerKita
		},
		{	
			name: "OpenCycleMap",
			layer: L.tileLayer('http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png')
		},
		{
			name: "Outdoors",
			layer: L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png')
		}
	];

	<?php
		$getKecamatan=$db->ObjectBuilder()->get('m_kecamatan');
		foreach ($getKecamatan as $row) {
			?>

			var myStyle<?=$row->id_kecamatan?> = {
			    "color": "<?=$row->warna_kecamatan?>",
			    "weight": 1,
			    "opacity": 1
			};

			<?php
			$arrayKec[]='{
			name: "'.$row->nm_kecamatan.'",
			icon: iconByName("'.$row->warna_kecamatan.'"),
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row->geojson_kecamatan.'"],{onEachFeature:popUp,style: myStyle'.$row->id_kecamatan.',pointToLayer: featureToMarker }).addTo(map)
			}';
		}
	?>

	var overLayers = [{
		group: "Layer Kecamatan",
		layers: [
			<?=implode(',', $arrayKec);?>
		]
	}
	];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
		collapsibleGroups: true
	});

	map.addControl(panelLayers);

	// marker
	var markers = L.markerClusterGroup();

	var myIcon = L.Icon.extend({
	    options: {
	    	iconSize: [38, 45]
	    }
	});

	<?php
	$db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
	$getdata=$db->ObjectBuilder()->get('t_hotspot a');
	foreach ($getdata as $row) {
		?>
		var marker  = L.marker([<?=$row->lat?>,<?=$row->lng?>],{icon: new myIcon({iconUrl: '<?=($row->marker=='')?assets('icons/marker.png'):assets('unggah/marker/'.$row->marker)?>'})})
				.bindPopup("Lokasi : <?=$row->lokasi?>,Kec. <?=$row->nm_kecamatan?><br>Keterangan : <?=$row->keterangan?><br>Tanggal : <?=$row->tanggal?>");
		markers.addLayer(marker);
		<?php
	}
	?>
	map.addLayer(markers);

   </script>