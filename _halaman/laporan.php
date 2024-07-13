<?php
$title = "Halaman Laporan";
$judul = $title;
$url = 'laporan';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .signature-section {
            display: none;
            margin-top: 50px;
        }

        .signature-section .sign-box {
            width: 50%;
            float: left;
            text-align: center;
        }

        .signature-section .sign-box.right {
            float: right;
        }

        .signature-section .clear {
            clear: both;
        }

        @media print {
            .signature-section {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">

        <h4>Laporan Pengisian Data Pangan Unggulan (Padi) Kecamatan di Kab. Barito Kuala</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr class="info">
                        <th>Nama Pengguna yg Mengisi</th>
                        <th>Kode Kecamatan</th>
                        <th>Nama Kecamatan</th>
                        <th>File GeoJSON</th>
                        <th>Jumlah Pangan (dalam ton)</th>
                        <th>Tanggal Pengisian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $db = mysqli_connect('localhost', 'root', '', 'webgis_pangan');

                    if ($db->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    }

                    $totalTon = 0; // Initialize total ton variable

                    // SQL query to fetch data
                    $sql = "SELECT 
                            p.nm_pengguna,
                            k.nm_kecamatan,
                            k.kd_kecamatan,
                            k.geojson_kecamatan,
                            k.jml_pangan,
                            k.tgl_isi
                        FROM 
                            data_entries e
                        JOIN 
                            pengguna p ON e.id_pengguna = p.id_pengguna
                        JOIN 
                            m_kecamatan k ON e.id_kecamatan = k.id_kecamatan";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $jmlPanganText = $row['jml_pangan'];

                            // Extract the numeric value from the string
                            preg_match('/(\d+)/', $jmlPanganText, $matches);
                            $jmlPangan = isset($matches[1]) ? floatval($matches[1]) : 0;

                            $totalTon += $jmlPangan; // Add jml_pangan to total ton

                            echo "<tr>
                                <td>{$row['nm_pengguna']}</td>
                                <td>{$row['kd_kecamatan']}</td>
                                <td>{$row['nm_kecamatan']}</td>
                                <td>{$row['geojson_kecamatan']}</td>
                                <td>{$jmlPanganText} ton</td>
                                <td>{$row['tgl_isi']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'><code>Belum ada yg mengisi Data!</code></td></tr>";
                    }

                    $db->close();
                    ?>
                </tbody>

                <tfoot>
                    <tr class="danger">
                        <td colspan="4">
                            <b>Total Pangan Unggulan (Padi) di Kab. Batola</b>
                        </td>
                        <td colspan="1">
                            <b><?php echo $totalTon ?> ton </b>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>

            <!-- Tanda Tangan Scan-->
            <!-- <div class="signature-section" style="margin-top: 50px;">
                <div style="width: 50%; float: left; text-align: center;">
                    <p>Dosen Pengampu</p>
                    <img src="path/to/signature_dosen.png" alt="Tanda Tangan Dosen" style="width: 150px; height: auto;">
                    <p><b>Nama Dosen</b></p>
                </div>
                <div style="width: 50%; float: right; text-align: center;">
                    <p>Ketua Kelompok</p>
                    <img src="path/to/signature_ketua.png" alt="Tanda Tangan Ketua Kelompok" style="width: 150px; height: auto;">
                    <p><b>Nama Ketua Kelompok</b></p>
                </div>
                <div style="clear: both;"></div>
            </div> -->

        </div>

        <br>

        <div class="signature-section">
            <div class="sign-box">
                <p>Dosen Pengampu</p>
                <br><br><br><br>
                <p><b>Nama Dosen</b></p>
            </div>
            <div class="sign-box right">
                <p>Ketua Kelompok</p>
                <br><br><br><br>
                <p><b>Nama Ketua Kelompok</b></p>
            </div>
            <div class="clear"></div>
        </div>

        <h4>Laporan Pengisian Titik-titik Data Pangan di Kab. Barito Kuala</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr class="info">
                        <th>Nama Pengguna yg Mengisi</th>
                        <th>Lokasi</th>
                        <th>Nama Kecamatan</th>
                        <th>Keterangan</th>
                        <th>Lat</th>
                        <th>Lng</th>
                        <th>Tanggal Pengisian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $db = mysqli_connect('localhost', 'root', '', 'webgis_pangan');

                    if ($db->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    }

                    // SQL query to fetch Pangan data
                    $sql_Pangan = "SELECT 
                                    p.nm_pengguna,
                                    h.lokasi,
                                    k.nm_kecamatan,
                                    h.keterangan,
                                    h.lat,
                                    h.lng,
                                    h.tanggal
                                FROM 
                                    t_pangan h
                                JOIN 
                                    pengguna p ON h.id_pengguna = p.id_pengguna
                                JOIN 
                                    m_kecamatan k ON h.id_kecamatan = k.id_kecamatan";

                    $result_pangan = $db->query($sql_Pangan);

                    if ($result_pangan->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result_pangan->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['nm_pengguna']}</td>
                                <td>{$row['lokasi']}</td>
                                <td>{$row['nm_kecamatan']}</td>
                                <td>{$row['keterangan']}</td>
                                <td>{$row['lat']}</td>
                                <td>{$row['lng']}</td>
                                <td>{$row['tanggal']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'><code>Belum ada yg mengisi Data!</code></td></tr>";
                    }

                    $db->close();
                    ?>
                </tbody>
            </table>
        </div>

    </div>


</body>

</html>