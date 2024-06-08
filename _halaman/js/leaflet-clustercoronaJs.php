<!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
	crossorigin=""></script>


	<link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.css" />
	<link rel="stylesheet" href="assets/js/Leaflet.markercluster-master/dist/MarkerCluster.Default.css" />
	<script src="assets/js/Leaflet.markercluster-master/dist/leaflet.markercluster-src.js"></script>

   	<script type="text/javascript">

   	var map = L.map('mapid').setView([-3.824181, 114.8191513], 2);

   	var LayerKita=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox.dark',
	    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	});
	map.addLayer(LayerKita);

	// marker
	<?php
	$url="https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/1/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc%2CCountry_Region%20asc%2CProvince_State%20asc&outSR=102100&resultOffset=0&resultRecordCount=250&cacheHint=true";
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type : application/json',
			'Access-Control-Allow-Origin : *'
		]);
	$result= curl_exec($ch);
	curl_close($ch);
	?>
	var getCoronaJson=<?=$result?>;
	var coronaData=getCoronaJson.features;
	


	var markers = L.markerClusterGroup();
	for(i=0;i<coronaData.length;i++){
		var data=coronaData[i].attributes;
		if(data.Lat!=null && data.Long_!=null){
			var marker  = L.marker([data.Lat,data.Long_])
					.bindPopup(
							"Negara : "+data.Country_Region+"<br>"+
							"Provinsi : "+data.Province_State+"<br>"+
							"Terinfeksi : "+data.Confirmed+"<br>"+
							"Meninggal : "+data.Deaths+"<br>"+
							"Sembuh : "+data.Recovered+"<br>"
						);
			markers.addLayer(marker);
		}
	}
	map.addLayer(markers);

   </script>