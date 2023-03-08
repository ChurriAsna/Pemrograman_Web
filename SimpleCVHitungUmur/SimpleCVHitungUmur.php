<?php
$title ='My CV';
$tgl ='27-08-2002';
$lahir = new DateTime($tgl);
$hari_ini = new DateTime();

$umur = $hari_ini->diff($lahir);
/* Ini merupakan alternatif dari pemanggilan menghitung usia yang terdapat pada variabel "y" untuk tahun
"m" untuk bulan "d" untuk hari.
$y = $hari_ini->diff($lahir)->y;
$m = $hari_ini->diff($lahir)->m;
$d = $hari_ini->diff($lahir)->d; */
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title><?php echo $title; ?></title>
    <style type="text/css"></style>

    <link rel="stylesheet" href="cv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>

    <div class="main">
        <?php
        echo '<div class="bagian-atas"><img src="Bio.jpg" class="profil">';
        echo '<p class="p1">CHURRI ASNA FATCHIYAH</p>';
        echo '<p class="p2">MAHASISWI</p></div>';
        ?>

        <div class="kolom-kiri">
            <?php
            echo '<div class="kotak-konten">';
                echo '<p class="sub-judul">KONTAK</p>';
                echo '<p class="p3"><i class="fa fa-phone"></i>&nbsp;&nbsp;+62 823-3812-3433</p>';
                echo '<p class="p3"><i class="fa fa-envelope"></i>&nbsp;&nbsp;churriasna278@gmail.com</p>';
                echo '<p class="p3"><i class="fa fa-home"></i>&nbsp;&nbsp;Kediri, Jawa Timur, Indonesia</p>';
            echo '</div>';
            ?>

            <?php 
            echo '<div class="kotak-konten">';
                echo '<p class="sub-judul">KEMAMPUAN</p>';
                echo '<ul>';
                    echo '<li class="p3">Toleransi</li>';
                    echo '<li class="p3">Empati</li>';
                    echo '<li class="p3">Fleksibilitas</li>';
                    echo '<li class="p3">Kesabaran</li>';
                    echo '<li class="p3">Time Manajemen</li>';
                echo '</ul>';
            echo '</div>';
            ?>

            <?php
            echo '<div class="kotak-konten">';
                echo '<p class="sub-judul">MINAT</p>';
                echo '<p class="p3"><i class="fa fa-book-open-reader"></i> &nbsp;&nbsp;Baca Buku</p>';
                echo '<p class="p3"><i class="fa fa-headphones-simple"></i> &nbsp;&nbsp;Mendengarkan Musik</p>';
                echo '<p class="p3"><i class="fa fa-feather-pointed"></i> &nbsp;&nbsp;Journaling</p>';
            echo '</div>';
            ?>

            <?php
            echo '<div class="kotak-konten">';
                echo '<p class="sub-judul">BAHASA</p>';
                echo '<p class="p3">Jawa</p>';
                echo '<p class="p3">Indonesia</p>';
            echo '</div>';
            ?>
        </div>
        
        <div class="line"></div>
        <div class="kolom-kanan">
            <div class="kotak-konten">
                <p class="sub-judul" align="right">TENTANG SAYA &nbsp;&nbsp;<i class="fa fa-person"></i></p>
                <P class="p3" style="line-height: 2;">Saya adalah seorang mahasiswi yang sedang menempuh jenjang pendidikan di 
                    Universitas Pembangunan Nasional "Veteran" Jawa Timur. Saya terbiasa untuk melakukan 
                    sesuatu dengan teliti dan dapat memenuhi tenggat waktu secara efektif.<br>Saya lahir pada 
                    tanggal <?php echo $tgl; ?> dan saat ini saya berusia <?php echo $umur->y. " tahun " .$umur->m. " bulan " .$umur->d. " hari. "?></P>
            </div>

            <div class="kotak-konten">
                <p class="sub-judul" align="right">PENGALAMAN ORGANISASI &nbsp;&nbsp;<i class="fa fa-solid fa-briefcase"></i></p>
                <ul>
                    <li class="p3">Anggota aktif Palang Merah Indonesia (PMI)</li>
                    <li class="p3">Panitia Donor Darah</li>
                    <li class="p3">Panitia Vaksin Difteri</li>
                    <li class="p3">Panitia Penerimaan Anggota Baru PMI</li>
                </ul>
            </div>

            <div class="kotak-konten">
                <p class="sub-judul" align="right">PENDIDIKAN &nbsp;&nbsp;<i class="fa fa-graduation-cap"></i></p>
                <p class="p3">(2018 - 2021) SMAN 4 KEDIRI</p>
                <p class="p3">(2021 - SEKARANG) UPN Veteran Jawa Timur</p>
            </div>
        </div>
    </div>
    
</body>
</html>