
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=templates()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$session->get("nm_pengguna")?> [<?=$session->get("level")?>]</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?=url('beranda')?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>
        <?php if ($session->get('level')=='Admin'): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('kecamatan')?>"><i class="fa fa-circle-o"></i> Kecamatan</a></li>
          </ul>
        </li>
        <?php endif ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-sitemap"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('hotspot')?>"><i class="fa fa-circle-o"></i> Hotspot</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-map"></i>
            <span>Leaflet</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('leaflet-standar')?>"><i class="fa fa-circle-o"></i> Standar</a></li>
            <li><a href="<?=url('leaflet-point')?>"><i class="fa fa-circle-o"></i> Point</a></li>
            <li><a href="<?=url('leaflet-pointmarker')?>"><i class="fa fa-circle-o"></i> Point Marker</a></li>
            <li><a href="<?=url('leaflet-pointgeojson')?>"><i class="fa fa-circle-o"></i> Point Marker GeoJSON</a></li>
            <li><a href="<?=url('leaflet-cluster')?>"><i class="fa fa-circle-o"></i> Cluster</a></li>
            <li><a href="<?=url('leaflet-clustercorona')?>"><i class="fa fa-circle-o"></i> Cluster Corona</a></li>
            <li><a href="<?=url('leaflet-heatmap')?>"><i class="fa fa-circle-o"></i> Heatmap</a></li>
            <li><a href="<?=url('leaflet-choroplet')?>"><i class="fa fa-circle-o"></i> Choroplet</a></li>
            <li><a href="<?=url('leaflet-routingmachine')?>"><i class="fa fa-circle-o"></i> Routing Machine</a></li>
          </ul>
        </li>
        <li>
          <a href="<?=url('logout')?>">
            <i class="fa fa-sign-out"></i> <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
