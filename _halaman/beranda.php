<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/beranda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    $title = "Beranda";
    $judul = $title;

    // Database connection
    $db = mysqli_connect('localhost', 'root', '', 'webgis_pangan');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Fetch total users
    $sql_users = "SELECT COUNT(*) as total_users FROM pengguna";
    $result_users = $db->query($sql_users);
    $total_users = ($result_users->num_rows > 0) ? $result_users->fetch_assoc()['total_users'] : 0;

    // Fetch total districts
    $sql_districts = "SELECT COUNT(*) as total_districts FROM m_kecamatan";
    $result_districts = $db->query($sql_districts);
    $total_districts = ($result_districts->num_rows > 0) ? $result_districts->fetch_assoc()['total_districts'] : 0;

    // Fetch total food tonnage
    $sql_food = "SELECT SUM(jml_pangan) as total_tonnage FROM m_kecamatan";
    $result_food = $db->query($sql_food);
    $total_tonnage = ($result_food->num_rows > 0) ? $result_food->fetch_assoc()['total_tonnage'] : 0;

    $db->close();
    ?>

    <?= content_open('<strong>Halaman Beranda WebGIS Pangan Kabupaten Barito Kuala 🌾</strong>') ?>
    <?= $session->pull("info") ?>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengguna</span>
                    <span class="info-box-number"><?= $total_users ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa-solid fa-map-location-dot"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Kecamatan</span>
                    <span class="info-box-number"><?= $total_districts ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa-solid fa-seedling"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pangan 🌾</span>
                    <span class="info-box-number"><?= $total_tonnage ?> /ton</span>
                </div>
            </div>
        </div>
    </div>

    <?= content_close() ?>
</body>

</html>