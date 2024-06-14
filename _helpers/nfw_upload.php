<?php
  function upload($input_name, $folder) {
    $file_name = $_FILES[$input_name]['name'];
    $file_tmp = $_FILES[$input_name]['tmp_name'];
    $upload_directory = 'assets/unggah/' . $folder . '/';
    
    // Buat folder jika belum ada
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }
    
    $upload_path = $upload_directory . basename($file_name);

    if (move_uploaded_file($file_tmp, $upload_path)) {
        return $file_name;
    } else {
        return false;
    }
}
