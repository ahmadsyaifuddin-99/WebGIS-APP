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
                <h4>Error!</h4> Nama Pengguna atau Kata Sandi Salah
              </div>');
        redirect(url("login2"));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/login2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>

</head>

<body>
    <div class="box">

        <div class="container">
            <?= $session->pull("info") ?>

            <div class="top">
                <header><b>Login</b>WEBGIS Pangan</header>
            </div>
            <br>
            <form method="post">

                <div class="input-field">
                    <input type="text" class="input" name="nm_pengguna" placeholder="Nama Pengguna" id="" required>
                    <i class='bx bx-user'></i>
                </div>

                <div class="input-field">
                    <input type="Password" class="input" name="kt_sandi" placeholder="Password" id="" required>
                    <i class='bx bx-lock-alt'></i>
                </div>

                <div class="input-field">
                    <button type="submit" name="login" class="submit" id="">Log
                        in</button>
                </div>

            </form>

        </div>
    </div>
</body>

<?php
include '_layouts/javascript.php';
?>

</html>