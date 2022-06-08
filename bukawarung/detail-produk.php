<?php
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = $id");
$p = mysqli_fetch_object($produk);

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
    <!-- produk detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?= $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price)  ?></h4>
                    <p>Deskirpsi :<br>
                        <?php echo $p->product_description  ?>
                    </p>
                    <p>
                        <a href="https://api.whatsapp.com/send?phone=<?= $a->admin_telp ?>&text=Hai, saya tertarik dengan produk anda <?= $p->product_name ?>" target="_blank"> <img src="img/whatsapp.png" alt="" width="50px"> <br> <b>Hubungi via Whatsapp</b></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?= $a->admin_address ?></p>
            <h4>Email</h4>
            <p><?= $a->admin_email ?></p>
            <h4>No. HP</h4>
            <p><?= $a->admin_telp ?></p>
            <small>Copyright &copy; 2021 - Bukawarung</small>
        </div>
    </div>
</body>

</html>
