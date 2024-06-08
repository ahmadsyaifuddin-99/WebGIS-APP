<?php
	$setTemplate=false;
	if(isset($_POST['login'])){
    $nm_pengguna=$_POST['nm_pengguna'];
    $kt_sandi=$_POST['kt_sandi'];
    $db->where("nm_pengguna",$nm_pengguna);
    $data=$db->ObjectBuilder()->getOne("pengguna");
    if($db->count>0){
      // jika username ada
      $hash = $data->kt_sandi;
      if (password_verify($kt_sandi, $hash)) {
          $session->set("logged",true);
          $session->set("nm_pengguna",$data->nm_pengguna);
          $session->set("id_pengguna",$data->id_pengguna);
          $session->set("level",$data->level);
          $session->set("info",'<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Selamat Datang <b>'.$data->nm_pengguna.'</b> di Halaman Utama Aplikasi
                  </div>');
          redirect(url("beranda"));
      } else {
         $session->set("logged",false);
         $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> Nama Pengguna atau Kata Sandi Salah
              </div>');
        redirect(url("login"));
      }
    }
    else{
      $session->set("logged",false);
      $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> Nama Pengguna atau Kata Sandi Salah
              </div>');
      redirect(url("login"));
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
	<?php include '_layouts/head.php'?>
	<link rel="stylesheet" href="<?=templates()?>plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Login</b>WEBGIS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?=$session->pull("info")?>
    <form  method="post">
      <label>Nama Pengguna</label>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nm_pengguna" placeholder="Nama Pengguna">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <label>Kata Sandi</label>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="kt_sandi"  placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
<?php
  include '_layouts/javascript.php';
?>
<script src="<?=templates()?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</html>