<?php
// Proses pengisian data kecamatan
$db = new mysqli('localhost', 'root', '', 'webgis_pangan');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Ambil data dari form
$id_pengguna = $_POST['id_pengguna']; // ID pengguna yang sedang aktif
$id_kecamatan = $_POST['id_kecamatan']; // ID kecamatan yang diisi oleh pengguna

$sql = "INSERT INTO data_entries (id_pengguna, id_kecamatan) VALUES (?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("ii", $id_pengguna, $id_kecamatan);

if ($stmt->execute()) {
    echo "Data successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$db->close();
?>
