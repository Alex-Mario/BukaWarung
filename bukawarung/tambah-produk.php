<?php
include 'db.php';
session_start();
if ($_SESSION['status_login'] != true) {
    header("location:login.php");
}
if (isset($_POST["submit"])) {
    // print_r($_FILES['gambar']);
    // menampung inputan dari form
    // menampung data file yang diupload
    // menampung format file yang di ijinkan
    // validasi format file
    // proses upload file sekaligus insert ke database
    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $type1 = explode(".", $filename);
    $type2 = strtolower($type1[1]); // format file
    $tipe_diizinkan = ['jpg', 'jpeg', 'png', 'gif'];
    $newname = 'produk' . time() . '.' . $type2;
    if (!(in_array($type2, $tipe_diizinkan))) {
        echo "<script>alert(`Format file tidak diizinkan`)</script>";
    } else {
        move_uploaded_file($tmp_name, './produk/' . $newname);
        $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(null, '$kategori','$nama','$harga','$deskripsi','$newname','$status',null)");
        if ($insert) {
            echo "<script>alert('simpan data berhasil'); document.location.href ='data-produk.php'; </script>";
        } else {
            echo 'gagal' . mysqli_error($conn);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukawarung</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Bukawarung</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- konten -->
    <div class="section">
        <div class="container">
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" class="input-control" required>
                        <option value="">--Pilih--</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT category_id, category_name FROM tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_array($kategori)) {
                        ?>
                            <option value="<?php echo $r['category_id'] ?>"><?php echo $r["category_name"]  ?></option>
                        <?php }  ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"></textarea>
                    <br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <button type="submit" name="submit" class="btn">Submit</button>

                </form>
            </div>

        </div>
    </div>
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - Bukawarung</small>
        </div>
    </footer>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>

</html>