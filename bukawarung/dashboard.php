<?php 
    session_start();
    if($_SESSION['status_login']!=true){
        header("location:login.php");
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
             <h3>Dashboard</h3>
             <div class="box">
                <h4>Selamat datang <?php echo $_SESSION['a_global']->admin_name?> di Toko Online </h4>
             </div>
        </div>
    </div>
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2021 - Bukawarung</small>
        </div>
    </footer>
</body>
</html>