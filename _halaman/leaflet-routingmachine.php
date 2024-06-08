<?php
  $title="Leaflet - Routing Machine";
  $judul=$title;
  $url='leaflet-routingmachine';
  $fileJs='leaflet-routingmachineJs';

  $keterangan=(isset($_GET['keterangan']))?$_GET['keterangan']:'';
  $tahun=(isset($_GET['tahun']))?$_GET['tahun']:'semua';
 ?>
<?=content_open($title)?>
 	<div id="mapid"></div>
<?=content_close()?>
