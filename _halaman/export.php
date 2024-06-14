<?php
// Tidak ada output apapun sebelum header
ob_start();
include "../env.php";

// Set header untuk file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_pengisian_data_kecamatan.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Membuat tabel HTML
echo "<table border='1'>
    <thead>
        <tr>
            <th>Nama Pengguna yg Mengisi</th>
            <th>Kode Kecamatan</th>
            <th>Nama Kecamatan</th>
            <th>File GeoJSON</th>
            <th>Tanggal Pengisian</th>
        </tr>
    </thead>
    <tbody>";

// Koneksi ke database
$db = new mysqli('localhost', 'root', '', 'webgis_pangan');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Query SQL untuk mendapatkan data
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
    // Output data setiap baris
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

// Menutup koneksi database
$db->close();

// Mengakhiri tabel HTML
echo "</tbody></table>";

// Mengakhiri output buffering dan mengirim output ke browser
ob_end_flush();
?>
