<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
<script src="assets/js/leaflet.ajax.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-easyprint@2.1.9/dist/bundle.min.js"></script>

<script type="text/javascript">
    var map = L.map('mapid').setView([-3.06522, 114.6454817], 9);

    // Layer Map Hybrid
    let hybridLayer = L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
    });

    // Layer Map Satellite
    let satelliteLayer = L.tileLayer(
        'https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmF1eml5dXNhcmFobWFuIiwiYSI6ImNsZmpiOXBqYTJnbzUzcnBnNnJzMjB0ZHMifQ.AldZlBJVQaCALzRw-vhWiQ', {
            maxZoom: 20,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://        creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
        });

    map.addLayer(hybridLayer);

    var myStyle2 = {
        "color": "#ffff00",
        "weight": 1,
        "opacity": 0.9
    };

    function popUp(f, l) {
        var out = [];
        if (f.properties) {
            // Menampilkan informasi dasar
            out.push("Provinsi: " + f.properties['PROVINSI']);
            out.push("Kecamatan: " + f.properties['KECAMATAN']);

            // Menangkap dan menampilkan data PANGAN
            var pangan = f.properties['PANGAN'];
            if (pangan) {
                out.push("Pangan:");
                for (var key in pangan) {
                    if (pangan.hasOwnProperty(key)) {
                        out.push(key + ": " + pangan[key]);
                    }
                }

                // Mengikat popup dengan informasi yang dihasilkan
                l.bindPopup(out.join("<br />"));
            }
        }
    }

    // legend

    function iconByName(name) {
        return '<i class="icon" style="background-color:' + name + ';border-radius:50%"></i>';
    }

    function featureToMarker(feature, latlng) {
        return L.marker(latlng, {
            icon: L.divIcon({
                className: 'marker-' + feature.properties.amenity,
                html: iconByName(feature.properties.amenity),
                iconUrl: '../images/markers/' + feature.properties.amenity + '.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        });
    }

    var baseLayers = [{
            name: "Hybrid",
            layer: hybridLayer
        },
        {
            name: "Satellite",
            layer: satelliteLayer
        }
    ];

    <?php
    $getKecamatan = $db->ObjectBuilder()->get('m_kecamatan');
    foreach ($getKecamatan as $row) {
    ?>

        var myStyle<?= $row->id_kecamatan ?> = {
            "color": "<?= $row->warna_kecamatan ?>",
            "weight": 1,
            "opacity": 1
        };

    <?php
        $arrayKec[] = '{
			name: "' . $row->nm_kecamatan . '",
			icon: iconByName("' . $row->warna_kecamatan . '"),
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/' . $row->geojson_kecamatan . '"],{onEachFeature:popUp,style: myStyle' . $row->id_kecamatan . ',pointToLayer: featureToMarker }).addTo(map)
			}';
    }
    ?>

    var overLayers = [{
        group: "Layer Kecamatan",
        layers: [
            <?= implode(',', $arrayKec); ?>
        ]
    }];

    var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers, {
        collapsibleGroups: true
    });

    map.addControl(panelLayers);

    // marker
    var myIcon = L.Icon.extend({
        options: {
            iconSize: [38, 45]
        }
    });

    <?php
    $db->join('m_kecamatan b', 'a.id_kecamatan=b.id_kecamatan', 'LEFT');
    $getdata = $db->ObjectBuilder()->get('t_pangan a');
    foreach ($getdata as $row) {
    ?>
        L.marker([<?= $row->lat ?>, <?= $row->lng ?>], {
                icon: new myIcon({
                    iconUrl: '<?= ($row->marker == '') ? assets('icons/marker.png') : assets('unggah/marker/' . $row->marker) ?>'
                })
            }).addTo(map)
            .bindPopup(
                "Lokasi : <?= $row->lokasi ?>, Kec. <?= $row->nm_kecamatan ?><br>Keterangan : <?= $row->keterangan ?><br>Tanggal : <?= $row->tanggal ?>"
            );
    <?php
    }
    ?>

    L.easyPrint({
        title: 'Cetak Peta Kabupaten',
        position: 'topleft',
        sizeModes: ['A4Portrait', 'A4Landscape'],
        // exportOnly: true,
        hideControlContainer: true
    }).addTo(map);
</script>