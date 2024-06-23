<?php
$setTemplate = false;
if (isset($_POST['login'])) {
    $nm_pengguna = $_POST['nm_pengguna'];
    $kt_sandi = $_POST['kt_sandi'];
    $db->where("nm_pengguna", $nm_pengguna);
    $db->where("kt_sandi", $kt_sandi);
    $data = $db->ObjectBuilder()->getOne("pengguna");
    if ($db->count > 0) {
        $session->set("logged", true);
        $session->set("nm_pengguna", $data->nm_pengguna);
        $session->set("id_pengguna", $data->id_pengguna);
        $session->set("level", $data->level);
        $session->set("info", '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Selamat Datang <b>' . $data->nm_pengguna . ' (' . $data->level . ')</b> di Halaman Utama Aplikasi
              </div>');
        redirect(url("beranda"));
    } else {
        $session->set("logged", false);
        $session->set("info", '<div class="alert alert-danger alert-dismissible">
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
    <title>Login</title>
    <?php include '_layouts/head.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Login</b>WEBGIS <span style="color: green;"> Pangan Unggulan Batola <i
                        class="fa-solid fa-wheat-awn"></i></span></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?= $session->pull("info") ?>
            <form method="post">
                <label>Nama Pengguna</label>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nm_pengguna" placeholder="Nama Pengguna" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <label>Kata Sandi</label>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="kt_sandi" id="password" placeholder="Password"
                        required>
                    <span class="show-password" onclick="togglePasswordVisibility()">
                        <i class="fa fa-eye" id="eye-icon"></i>
                    </span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" name="login" class="btn btn-success btn-block btn-flat">Sign In</button>
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

<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
</script>


</html>