<?php
$title = "Leaflet - Choroplet Map";
$judul = $title;
$url = 'leaflet-choroplet';
$fileJs = 'leaflet-choropletJs';
?>
<style type="text/css">
  .skin-red .user-panel>.info,
  .skin-red .user-panel>.info>a {
    color: #000;
  }

  .info {
    padding: 6px 8px;
    font: 13px;
    color: #fff;
    background: transparent;
    backdrop-filter: blur(50px);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
  }

  .info h4 {
    margin: 0 0 5px;
    color: #fff;
  }

  .legend {
    text-align: left;
    line-height: 18px;
    color: #fff;
  }

  .legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
  }
</style>
<?= content_open($title) ?>
<div id="mapid"></div>
<br>
<div class="col-md-2">
  <select id="panganSelect" style="color: #000;" class="form-control">
    <option value="PADI">Padi</option>
    <option value="JAGUNG">Jagung</option>
    <option value="KEDELAI">Kedelai</option>
    <option value="KACANG HIJAU">Kacang Hijau</option>
    <option value="UBI KAYU">Ubi Kayu</option>
    <option value="UBI JALAR">Ubi Jalar</option>
  </select>
</div>

<?= content_close() ?>