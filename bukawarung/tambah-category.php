<?php
include 'db.php';
session_start();
if ($_SESSION['status_login'] != true) {
    header("location:login.php");
}
if (isset($_POST["submit"])) {
    $nama = ucwords($_POST["nama"]);
    $filename = $_FILES['gambar']['name'];
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $type1 = explode(".", $filename);
    $type2 = strtolower($type1[1]); // format file
    $tipe_diizinkan = ['jpg', 'jpeg', 'png', 'gif'];
    $newname = 'gambar kategori ' . $nama . '.' . $type2;
    if (!(in_array($type2, $tipe_diizinkan))) {
        echo "<script>alert(`Format file tidak diizinkan`)</script>";
    } else {
        move_uploaded_file($tmp_name, './kategori/' . $newname);
        $insert = "INSERT INTO tb_category VALUES (null,'$nama','$newname')";
        $query = mysqli_query($conn, $insert);
        if ($query) {
            echo "<script>alert('tambah kategori berhasil'); document.location.href ='data-kategori.php'; </script>";
        } else {
            echo "gagal" . mysqli_error($conn);
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
            <h3>Tambah Data Category</h3>
            <div class="box">
                <form acrtion="" enctype="multipart/form-data" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                    <input type="file" name="gambar" class="input-control" required>
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
</body>

</html>