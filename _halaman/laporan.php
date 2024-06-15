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
    $url = 'laporan';
    ?>

    <div class="container-fluid">
        <h4 class="mt-5">Laporan Pengisian Data Kecamatan di Kab. Barito Kuala</h4>
        <!-- <a href="<?=url($url)?>" class="btn btn-success"><i class="fa-solid fa-file-excel"></i> Export ke Excel</a><br><br> -->
        <div class="table-responsive">
        <table class="table table-hover table-bordered mt-3">
            <thead>
                <tr>
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
                $db = new mysqli('localhost', 'root', '', 'webgis_pangan');

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
                                <td>{$jmlPanganText}</td>
                                <td>{$row['tgl_isi']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada yg mengisi Data!</td></tr>";
                }

                $db->close();
                ?>
                <tr class="bg-danger">
                    <td colspan="4" align="center">
                        <b>Total Ton Pangan Unggulan di Kab. Batola</b>
                    </td>
                    <td colspan="1" align="center">
                        <b>Total Pangan Unggulan: <?php echo $totalTon ?>/ton </b>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
        
    </div>
</body>
</html>
