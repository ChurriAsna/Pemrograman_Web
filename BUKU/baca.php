<!DOCTYPE html>
<html>
<head>
    <title>DATA BUKU</title>
</head>
<body>
    <h2 align='center'>Data Buku</h2><br>
    <table align='center' border=1 cellpadding=10 cellspacing=0>
        <tr>
            <th>Kode</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun Terbit</th>
            <th>Jumlah</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th>Cover</th>
        </tr>
        <?php
        $txtFile = fopen('buku.txt', 'r');
        if ($txtFile) {
            while (($baris = fgets($txtFile)) !== false) {
                $data = explode("-", $baris);
                
                $kode = $data[0];
                $judul = $data[1];
                $pengarang = $data[2];
                $tahun = $data[3];
                $jumlah = $data[4];
                $penerbit = $data[5];
                $kategori = $data[6];
                $cover = $data[7];

                echo '<tr>';
                echo '<td>' . $kode . '</td>';
                echo '<td>' . $judul . '</td>';
                echo '<td>' . $pengarang . '</td>';
                echo '<td>' . $tahun . '</td>';
                echo '<td>' . $jumlah . '</td>';
                echo '<td>' . $penerbit . '</td>';
                echo '<td>' . $kategori . '</td>';
                echo '<td><img src="img/' . $cover . '" alt="Cover" width="150"></td>';
                echo '</tr>';

            }
            fclose($txtFile);
            
        }

        ?>
    </table>
</body>
</html>

<div align='center'><br><br><a href="form.php">Kembali ke Form</a><br><br></div>