<?php
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
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
                <li><a href="produk.php">Produk</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </header>
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?= $_GET['search'] ?>">
                <input type="submit" name="cari" placeholder="Cari Produk">
                <input type="hidden" name="kat" value="<?= $_GET['kat'] ?>">
            </form>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if (mysqli_num_rows($kategori) > 0) {
                    while ($k = mysqli_fetch_array($kategori)) {
                ?>
                        <a href="produk.php?kat=<?= $k['category_id'] ?>">
                            <div class="col-5">
                                <img src="kategori/<?= $k['category_image'] ?>" alt="" width="50px" style="margin-bottom:5px">
                                <p><?= $k['category_name'] ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Kategori tidak ada</p>
                <?php }  ?>
            </div>
        </div>
    </div>
    <!-- new produk -->
    <div class="section">
        <div class="container">
            <div class="box">
                <?php
                if ($_GET['search'] != '' || $_GET['kat'] != '') {
                    $where = "AND product_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%'";
                }
                $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status=1 $where");
                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_array($produk)) {
                ?>
                        <a href="detail-produk.php?id=<?= $p['product_id'] ?>">
                            <div class="col-4">
                                <img src="produk/<?= $p['product_image'] ?>" alt="">
                                <p class="nama"><?= substr($p['product_name'], 0, 30)  ?></p>
                                <p class="harga">Rp. <?= number_format($p['product_price']) ?></p>
                            </div>
                        </a>
                    <?php }
                } else {  ?>
                    <p>Produk Tidak Ada</p>
                <?php }  ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <h4>Bukawarung</h4>
            <small>Copyright &copy; 2022 - Bukawarung</small>
        </div>
    </div>
</body>

</html>