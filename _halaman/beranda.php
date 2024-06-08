<?php
  $title="Beranda";
  $judul=$title;
?>
<?=content_open('Halaman Beranda')?>
    <?=$session->pull("info")?>
<?=content_close()?>
