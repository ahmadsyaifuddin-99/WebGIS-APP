<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
    integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
    crossorigin=""></script>

<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
<script src="assets/js/leaflet.ajax.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-easyprint@2.1.9/dist/bundle.min.js"></script>

<script type="text/javascript">
let selectedPangan = "PADI";

var map = L.map('mapid').setView([-3.06522, 114.6454817], 10);

// Layer Map Hybrid
let hybridLayer = L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
});

// Layer Map Satelite
let satelliteLayer = L.tileLayer(
    'https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmF1eml5dXNhcmFobWFuIiwiYSI6ImNsZmpiOXBqYTJnbzUzcnBnNnJzMjB0ZHMifQ.AldZlBJVQaCALzRw-vhWiQ', {
        maxZoom: 20,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
    });

map.attributionControl.addAttribution(
    'Produksi Pangan &copy; <a href="https://baritokualakab.bps.go.id/">BPS Batola</a>');

map.addLayer(hybridLayer);

// control that shows state info on hover
var info = L.control();

info.onAdd = function(map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info.update = function(props) {
    this._div.innerHTML = '<h4>Produksi Pangan di Kab. Batola 🌾</h4>' + (props ?
        '<b>' + props.KECAMATAN + '</b><br />' + selectedPangan + ': ' + props.PANGAN[selectedPangan] +
        ' /ton' :
        'Arahkan kursor ke Kecamatan');
};

info.addTo(map);

// legend
function iconByName(name) {
    return '<i class="icon" style="background-color:' + name + ';border-radius:50%"></i>';
}

var baseLayers = [{
        name: "Hybrid",
        layer: hybridLayer
    },
    {
        name: "Satelite",
        layer: satelliteLayer
    }
];

// Get color depending on production value
function getColor(d) {
    return d > 40000 ? '#00441b' : // Hijau sangat gelap
        d > 30000 ? '#238823' : // Hijau gelap
        d > 20000 ? '#41ab5d' : // Hijau tua
        d > 10000 ? '#78c679' : // Hijau
        d > 5000 ? '#addd8e' : // Hijau muda
        d > 1000 ? '#d9f0a3' : // Hijau terang
        '#FFEDA0'; // Krim
}

// Legend control
let legend = L.control({
    position: 'bottomright'
});

legend.onAdd = function(_map) {
    let div = L.DomUtil.create('div', 'info legend'),
        grades = [0, 1000, 5000, 10000, 20000, 30000, 40000],
        labels = ['<strong>Produksi per ton</strong>'],
        from, to;

    for (let i = 0; i < grades.length; i++) {
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

// Function to handle the dropdown change
document.getElementById('panganSelect').addEventListener('change', function() {
    selectedPangan = this.value;
    updateMap();
});

function style(feature) {
    let productionValue = feature.properties.PANGAN[selectedPangan] || 0;
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColor(productionValue)
    };
}

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#d9f0a3',
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

// Load GeoJSON and apply styles
<?php
    $getKecamatan = $db->ObjectBuilder()->get('m_kecamatan');
    foreach ($getKecamatan as $row) {
    ?>
<?php
        $arrayKec[] = '{
            name: "' . $row->nm_kecamatan . '",
            icon: iconByName("' . $row->warna_kecamatan . '"),
            layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/' . $row->geojson_kecamatan . '"],{
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map)
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
    collapsibleGroups: true,
    position: "bottomleft"
});

map.addControl(panelLayers);

// Function to update the map layers
function updateMap() {
    overLayers[0].layers.forEach(function(layerItem) {
        layerItem.layer.eachLayer(function(layer) {
            layer.setStyle(style(layer.feature));
        });
    });
    info.update();
}

L.easyPrint({
    title: 'Cetak Peta Kabupaten',
    position: 'topright',
    sizeModes: ['A4Portrait', 'A4Landscape'],
    // exportOnly: true,
    hideControlContainer: true
}).addTo(map);
</script>