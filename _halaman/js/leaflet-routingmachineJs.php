<link rel="stylesheet" href="assets/js/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

<script src="assets/js/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>

    <script src="assets/js/leaflet-routing-machine/examples/Control.Geocoder.js"></script>

   <script type="text/javascript">

   	var map = L.map('mapid').setView([-3.824181, 114.809113], 16);

   	var LayerKita=L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
	});
	map.addLayer(LayerKita);
	L.marker([-3.824181, 114.809113]).addTo(map);

	// marker
	var myIcon = L.icon({
	    iconUrl: '<?=assets('icons/marker.png')?>',
	    iconSize: [38, 45],
	});
	<?php

	$db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
	$getdata=$db->ObjectBuilder()->get('t_hotspot a');
	foreach ($getdata as $row) {
		?>
		L.marker([<?=$row->lat?>,<?=$row->lng?>],{icon: myIcon}).addTo(map)
				.bindPopup("Lokasi : <?=$row->lokasi?>,"+
							"Kec. <?=$row->nm_kecamatan?><br>"+
							"Keterangan : <?=$row->keterangan?><br>"+
							"Tanggal : <?=$row->tanggal?><br>"+
							"<button class='btn btn-info' onclick='return keSini(<?=$row->lat?>,<?=$row->lng?>)'>Ke Sini</button>");
		<?php
	}
	?>
	//rute

	var control = L.Routing.control({
	    waypoints: [
	        L.latLng(-3.824181, 114.809113),
	        L.latLng(-3.524181, 114.609113)
	    ],
	    geocoder: L.Control.Geocoder.nominatim(),
		routeWhileDragging: true,
		reverseWaypoints: true,
		showAlternatives: true,
		altLineOptions: {
			styles: [
				{color: 'black', opacity: 0.15, weight: 9},
				{color: 'white', opacity: 0.8, weight: 6},
				{color: 'blue', opacity: 0.5, weight: 2}
			]
		}
	})
	control.addTo(map);

	function keSini(lat,lng){
        var latLng=L.latLng(lat, lng);
		control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng);
	}
   </script>