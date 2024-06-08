<?php
  $title="Leaflet - Point";
  $judul=$title;
  $url='leaflet-point';
  $fileJs='leaflet-pointJs';

  $keterangan=(isset($_GET['keterangan']))?$_GET['keterangan']:'';
  $tahun=(isset($_GET['tahun']))?$_GET['tahun']:'semua';
 ?>
<?=content_open($title)?>
	<form>
		<div class="row">
			<?=input_hidden('halaman',$url)?>
			<div class="col-md-3">
				<?=input_text('keterangan',$keterangan)?>
			</div>
			<div class="col-md-3">
				<?php
					$op=null;
					$op['semua']='Semua';
					for ($i=2018; $i <= date('Y') ; $i++) { 
						$op[$i]=$i;
					}
					echo select('tahun',$op,$tahun);
				?>
			</div>	
			<div class="col-md-3">
				<button type="submit" class="btn btn-info">Tampilkan</button>
			</div>
		</div>
	</form>
	<hr>
 	<div id="mapid"></div>
<?=content_close()?>
