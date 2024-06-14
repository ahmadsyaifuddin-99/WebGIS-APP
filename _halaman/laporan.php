<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengisian Data Kecamatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php
    $title = "Laporan";
    $judul = $title;
    $url = 'export';
    ?>

    <div class="container">
        <h1 class="mt-5">Laporan Pengisian Data Kecamatan</h1>
        <!-- <a href="<?=url($url)?>" class="btn btn-success"><i class="fa-solid fa-file-excel"></i> Export ke Excel</a><br><br> -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama Pengguna yg Mengisi</th>
                    <th>Kode Kecamatan</th>
                    <th>Nama Kecamatan</th>
                    <th>File GeoJSON</th>
                    <th>Tanggal Pengisian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                // Database connection
                $db = new mysqli('localhost', 'root', '', 'webgis_pangan');

                if ($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }

                // SQL query to fetch data
                $sql = "SELECT 
                            p.nm_pengguna,
                            k.nm_kecamatan,
                            k.kd_kecamatan,
                            k.geojson_kecamatan,
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
                        echo "<tr>
                                <td>{$row['nm_pengguna']}</td>
                                <td>{$row['kd_kecamatan']}</td>
                                <td>{$row['nm_kecamatan']}</td>
                                <td>{$row['geojson_kecamatan']}</td>
                                <td>{$row['tgl_isi']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }

                $db->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
