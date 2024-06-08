<!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>

   <script type="text/javascript">
	<?php
	$db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
	$getdata=$db->ObjectBuilder()->get('t_hotspot a');
	$jsonPoint=array();
	foreach ($getdata as $row) {
		$saveJson=null;
		$saveJson['type']="Feature";
		$saveJson['properties']=[
									"name"=>$row->lokasi,
									"lokasi"=>$row->lokasi.' Kec. '.$row->nm_kecamatan,
									"keterangan"=>$row->keterangan,
									"tanggal"=>$row->tanggal,
									"icon"=>($row->marker=='')?assets('icons/marker.png'):assets('unggah/marker/'.$row->marker),
									"popUp"=>"Lokasi : ".$row->lokasi.", Kec. ".$row->nm_kecamatan."<br>Keterangan : ".$row->keterangan."<br>Tanggal : ".$row->tanggal
									];
		$saveJson['geometry']=[
									"type" => "Point",
									"coordinates" => [$row->lng,$row->lat ] 
									];	

		$jsonPoint[]=$saveJson;
	}

	?>

	var geojsonPoint = <?=json_encode($jsonPoint, JSON_PRETTY_PRINT)?>;

   	var map = L.map('mapid').setView([-3.824181, 114.8191513], 11);

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
	var myIcon = L.Icon.extend({
	    options: {
	    	iconSize: [38, 45]
	    }
	});
	


	L.geoJSON(geojsonPoint, {
	    pointToLayer: function (feature, latlng) {
	    	console.log(feature)
	        return L.marker(latlng, {
	        	icon : new myIcon({iconUrl: feature.properties.icon})
	        });
	    },
    	onEachFeature: function(feature,layer){
    		 if (feature.properties && feature.properties.name) {
		        layer.bindPopup(feature.properties.popUp);
		    }
    	}
	}).addTo(map);


   </script>