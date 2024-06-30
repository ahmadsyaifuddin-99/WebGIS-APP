<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/beranda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    /* Menengahkan Posisi Div Chartnya */
    .center-content {
        display: flex;
        justify-content: center;
    }

    /* Menambahkan background pada canvas */
    #chartCanvas {
        background-color: #efefefef;
    }
    </style>
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

    // Fetch data for charts
    $sql_chart_data = "SELECT nm_kecamatan, jml_pangan FROM m_kecamatan";
    $result_chart_data = $db->query($sql_chart_data);

    $kecamatan_names = [];
    $jumlah_pangan = [];

    if ($result_chart_data->num_rows > 0) {
        while ($row = $result_chart_data->fetch_assoc()) {
            $kecamatan_names[] = $row['nm_kecamatan'];
            $jumlah_pangan[] = $row['jml_pangan'];
        }
    }

    $db->close();
    ?>

    <?= content_open('<strong>Halaman Beranda WebGIS <span class="text-green">Pangan Kabupaten Barito Kuala <i class="fa-solid fa-wheat-awn"></i></span> </strong>') ?>
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
                <span class="info-box-icon bg-green"><i class="fa-solid fa-wheat-awn"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pangan 🌾</span>
                    <span class="info-box-number"><?= $total_tonnage ?> ton</span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row center-content">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Produksi Pangan (Padi 🌾) per Kecamatan
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item ">
                                <button class="nav-link btn-warning" onclick="updateChartType('bar')"><i
                                        class="fa-solid fa-chart-column"></i> Bar</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link btn-warning" onclick="updateChartType('pie')"><i
                                        class="fa-solid fa-chart-pie"></i> Pie</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link btn-warning" onclick="updateChartType('polarArea')"><i
                                        class="fa-solid fa-sun"></i> Polar
                                    Area</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartCanvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    const labels = <?= json_encode($kecamatan_names) ?>;
    const data = <?= json_encode($jumlah_pangan) ?>;
    let chartType = 'bar';

    const ctx = document.getElementById('chartCanvas').getContext('2d');
    let chart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Produksi Pangan (Padi 🌾) ',
                data: data,
                backgroundColor: 'LightSeaGreen',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            animation: {
                duration: 3000,
                easing: 'easeInOutBounce'
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function updateChartType(newType) {
        chart.destroy();
        chartType = newType;
        chart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Produksi Pangan (Padi 🌾)',
                    data: data,
                    backgroundColor: [
                        'red',
                        'green',
                        'yellow',
                        'DeepSkyBlue',
                        'Indigo',
                        'orange'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(0, 128, 0, 0.596)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                animation: {
                    duration: 3000,
                    easing: 'easeInOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    </script>

    <?= content_close() ?>
</body>

</html>