<?php
$title ='My CV';
$tgl ='27-08-2002';
$lahir = new DateTime($tgl);
$hari_ini = new DateTime();

$umur = $hari_ini->diff($lahir);
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
            $data = array (
                array ('data1'=>'Toleransi'),
                array ('data1'=>'Empati'),
                array ('data1'=>'Fleksibilitas'),
                array ('data1'=>'Kesabaran'),
                array ('data1'=>'Time Manajemen'),
            )
            ?>


            <table class="kotak-konten" border="0" height="200" >
                <div style = "padding-left: 30px">
                    <p class="sub-judul">KEMAMPUAN</p>
                </div>
                <tbody>
                <?php foreach ($data as $saya) : ?>
                <tr>
                    <td class = "p3" width="250"><?php echo $saya['data1'] ?></td> 
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>

            <?php
            echo '<div class="kotak-konten">';
                echo '<p class="sub-judul">MINAT</p>';
                echo '<p class="p3"><i class="fa fa-book-open-reader"></i> &nbsp;&nbsp;Baca Buku</p>';
                echo '<p class="p3"><i class="fa fa-headphones-simple"></i> &nbsp;&nbsp;Mendengarkan Musik</p>';
                echo '<p class="p3"><i class="fa fa-feather-pointed"></i> &nbsp;&nbsp;Journaling</p>';
            echo '</div>';
            ?>

            <?php
            $data = array (
                array ('data1'=>'Jawa'),
                array ('data1'=>'Indonesia'),
            )
            ?>

            <table class="kotak-konten" border="0" height="100" >
                <div style = "padding-left: 30px">
                    <p class="sub-judul">BAHASA</p>
                </div>
                <tbody>
                <?php foreach ($data as $saya) : ?>
                <tr>
                    <td class = "p3" width="250"><?php echo $saya['data1'] ?></td> 
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
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

            <?php
            $data = array (
                array ('data1'=>'Anggota aktif Palang Merah Indonesia (PMI)'),
                array ('data1'=>'Panitia Donor Darah'),
                array ('data1'=>'Panitia Vaksin Difteri'),
                array ('data1'=>'Panitia Penerimaan Anggota Baru PMI'),
            )
            ?>

            <table class="kotak-konten" border="0" height="180" >
                <div>
                    <p align="right" class="sub-judul">PENGALAMAN ORGANISASI</p>
                </div>
                <tbody>
                <?php foreach ($data as $saya) : ?>
                <tr>
                    <td class = "p3" width="400"><?php echo $saya['data1'] ?></td> 
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>

            <?php
            $data = array (
                array ('data1'=>'(2018 - 2021) SMAN 4 KEDIRI'),
                array ('data1'=>'(2021 - SEKARANG) UPN Veteran Jawa Timur'),
            )
            ?>

            <table class="kotak-konten" border="0" height="100" >
                <div>
                    <p align="right" class="sub-judul">PENDIDIKAN</p>
                </div>
                <tbody>
                <?php foreach ($data as $saya) : ?>
                <tr>
                    <td class = "p3" width="400"><?php echo $saya['data1'] ?></td> 
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>