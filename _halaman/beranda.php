<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/beranda.css">
</head>
<body>
<?php
  $title="Beranda";
  $judul=$title;
?>
<?=content_open('<strong>Halaman Beranda WebGIS Pangan Kabupaten Barito Kuala 🌾</strong>')?>
    <?=$session->pull("info")?>
<?=content_close()?> 
</body>
</html>


