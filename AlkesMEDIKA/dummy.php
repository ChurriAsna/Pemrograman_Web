<?php
// Buat dummy file
$dummy_file_path = 'dummy_report.txt';
$content = "Ini adalah file dummy untuk pengujian pengiriman email.\n";
$content .= "Tanggal: " . date('Y-m-d H:i:s');

// Simpan isi ke dalam file
file_put_contents($dummy_file_path, $content);

echo "File dummy berhasil dibuat: $dummy_file_path";
?>
