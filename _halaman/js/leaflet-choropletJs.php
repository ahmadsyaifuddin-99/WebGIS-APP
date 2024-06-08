<!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>

   <script type="text/javascript">
   	<?php
   	$getKecamatan=$db->ObjectBuilder()->get('m_kecamatan');
	foreach ($getKecamatan as $row) {
		$db->where('id_kecamatan',$row->id_kecamatan);
		$db->get('t_hotspot');
		$data[$row->kd_kecamatan]=$db->count;
	}

   	?>

   	var HOTSPOT = <?=json_encode($data)?>; 

   	var map = L.map('mapid').setView([-3.824181, 114.8191513], 10);

   	var LayerKita=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
});
	map.addLayer(LayerKita);


	// control that shows state info on hover
	var info = L.control();

	info.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'info');
		this.update();
		return this._div;
	};

	info.update = function (props) {
		this._div.innerHTML = '<h4>Hotspost di Kabupaten Tanah Laut</h4>' +  (props ?
			'<b>' + props.KECAMATAN + '</b><br />' + HOTSPOT[props.KODE] + ' titik'
			: 'Dekatkan mouse untuk melihat');
	};

	info.addTo(map);
	// info panel

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

	// feature
	function getColor(d) {
		return d > 20 ? '#800026' :
				d > 14  ? '#BD0026' :
				d > 10  ? '#E31A1C' :
				d > 8  ? '#FC4E2A' :
				d > 6   ? '#FD8D3C' :
				d > 4   ? '#FEB24C' :
				d > 2   ? '#FED976' :
							'#FFEDA0';
	}



	var legend = L.control({position: 'bottomright'});

	legend.onAdd = function (map) {

		var div = L.DomUtil.create('div', 'info legend'),
			grades = [0, 2, 4, 6, 8, 10, 14, 20],
			labels = [],
			from, to;

		for (var i = 0; i < grades.length; i++) {
			from = grades[i];
			to = grades[i + 1];

			labels.push(
				'<i style="background:' + getColor(from + 1) + '"></i> ' +
				from + (to ? '&ndash;' + to : '+'));
		}

		div.innerHTML = labels.join('<br>');
		return div;
	};

	legend.addTo(map);


	function style(feature) {
		return {
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3',
			fillOpacity: 0.7,
			fillColor: getColor(HOTSPOT[feature.properties.KODE])
		};
	}

	function highlightFeature(e) {
		var layer = e.target;

		layer.setStyle({
			weight: 5,
			color: '#666',
			dashArray: '',
			fillOpacity: 0.7
		});

		if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
			layer.bringToFront();
		}

		info.update(layer.feature.properties);
	}

	function resetHighlight(e) {
		var layer = e.target;

		layer.setStyle({
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3'
		});

		info.update();
	}
	
	function zoomToFeature(e) {
		map.fitBounds(e.target.getBounds());
	}

	function onEachFeature(feature, layer) {
		layer.on({
			mouseover: highlightFeature,
			mouseout: resetHighlight,
			click: zoomToFeature
		});
	}

	<?php
		$getKecamatan=$db->ObjectBuilder()->get('m_kecamatan');
		foreach ($getKecamatan as $row) {
			?>
			<?php
			$arrayKec[]='{
			name: "'.$row->nm_kecamatan.'",
			icon: iconByName("'.$row->warna_kecamatan.'"),
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row->geojson_kecamatan.'"],{
				style: style,
				onEachFeature:onEachFeature
			}).addTo(map)
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
		collapsibleGroups: true,
		position:"bottomleft"
	});

	map.addControl(panelLayers);



   </script>