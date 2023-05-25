<?php
if (isset($_POST['submit'])) {
    $kode = $_POST['kode'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun = $_POST['tahun'];
    $jumlah = $_POST['jumlah'];
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];
    $cover = $_FILES['foto'];

    // Tentukan direktori tujuan penyimpanan foto
    $folderFoto = 'img/'.$cover['name'];

    // Pindahkan foto ke direktori tujuan
    move_uploaded_file($cover['tmp_name'], $folderFoto);

    // Simpan informasi buku dalam file buku.txt
    $txtFile = fopen('buku.txt', 'a');
    $txtData = $kode ."-". $judul ."-". $pengarang ."-". $tahun ."-". $jumlah ."-". $penerbit ."-". $kategori ."-". $cover['name'] ."\n";
    fwrite($txtFile, $txtData);
    fclose($txtFile);

    echo 'Data buku berhasil disimpan.';
    echo '<br><br><a href="form.php">Kembali ke Form</a>';
    echo '<br><br><a href="baca.php">Lihat Data</a>';
}
?>
