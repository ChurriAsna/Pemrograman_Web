<!DOCTYPE html>
<html lang="en">
<head>
    <title>PERPUSTAKAAN</title>
</head>
<body>
    <h3 align='center'>Input Data Buku</h3>

    <form action="simpan.php" method="POST" enctype="multipart/form-data">
        <table align='center'>
            <tr>
                <td><label for="kode">Kode Buku</label></td>
                <td><input type="text" name="kode" id="kode" required></td>
            </tr>
            <tr>
                <td><label for="judul">Judul Buku</label></td>
                <td><input type="text" name="judul" id="judul" required></td>
            </tr>
            <tr>
                <td><label for="pengarang">Pengarang</label></td>
                <td><input type="text" name="pengarang" id="pengarang" required></td>
            </tr>
            <tr>
                <td><label for="tahun">Tahun Terbit</label></td>
                <td><input type="text" name="tahun" id="tahun" required></td>
            </tr>
            <tr>
                <td><label for="jumlah">Jumlah Buku</label></td>
                <td><input type="text" name="jumlah" id="jumlah" required></td>
            </tr>
            <tr>
                <td><label for="penerbit">Penerbit</label></td>
                <td><input type="text" name="penerbit" id="penerbit" required></td>
            </tr>
            <tr>
                <td><label for="kategori">Kategori</label></td>
                <td><input type="text" name="kategori" id="kategori" required></td>
            </tr>
            <tr>
                <td><label for="foto">Cover</label></td>
                <td><input type="file" name="foto" id="foto" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Simpan"></td>
            </tr>

        </table>
    </form>
</body>
</html>