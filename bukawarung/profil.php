<?php 
    include 'db.php';
    session_start();
    if($_SESSION['status_login']!=true){
        header("location:login.php");
    }
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
    

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
             <h3>Profil</h3>
             <div class="box">
                 <form action="" method="POST">
                     <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name?>" required>
                     <input type="text" name="user" placeholder="Username" class="input-control" required value="<?php echo $d->username?>">
                     <input type="text" name="hp" placeholder="No Hp" class="input-control" required value="<?php echo $d->admin_telp?>">
                     <input type="text" name="email" placeholder="Email" class="input-control" required value="<?php echo $d->admin_email?>">
                     <input type="text" name="alamat" placeholder="Alamat" class="input-control" required value="<?php echo $d->admin_address?>">
                    <button type="submit" name="submit" class="btn">Ubah Profil</button>
                    <?php 
                        if(isset($_POST['submit'])){
                            $nama = ucwords($_POST['nama']);
                            $user = $_POST['user'];
                            $hp = $_POST['hp'];
                            $email = $_POST['email'];
                            $alamat = ucwords($_POST['alamat']);
                            $update = mysqli_query($conn, "UPDATE tb_admin SET admin_name='$nama',username='$user',admin_telp='$hp',admin_email='$email',admin_email='$email',admin_address='$alamat' WHERE admin_id='$d->admin_id'");
                            if($update){
                                echo"<script>alert('berhasil');
                                document.location.href = 'profil.php'</script>"; 
                            } else{
                                echo'gagal'.mysqli_error($conn);
                            }
                        }
                        
                    ?>
                 </form>
             </div>
             <h3>Ubah Password</h3>
             <div class="box">
                 <form action="" method="POST">
                    <input type="password" name="passLama" placeholder="Password Lama" class="input-control" required >
                     <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                     <input type="password" name="pass2" placeholder="Konfirmasi Paasword" class="input-control" required >
                     
                    <button type="submit" name="ubah_password" class="btn">Ubah Password</button>
                    <?php 
                        if(isset($_POST['ubah_password'])){
                            $passLama = md5($_POST['passLama']);
                            $pass1 = md5($_POST['pass1']);
                            $pass2 = md5($_POST['pass2']);
                            if($passLama===$d->password){
                                if($pass2!==$pass1){
                                    echo"<script>alert('Konfirmasi password tidak sesuai')</script>";
                                } else {
                                $u_pass = mysqli_query($conn, "UPDATE tb_admin SET password='$pass1' WHERE admin_id='$d->admin_id'");
                                if($u_pass){
                                    echo"<script>alert('berhasil');
                                    document.location.href = 'profil.php'</script>"; 
                                } else{
                                    echo'gagal'.mysqli_error($u_pass);
                                }
                            }
                        } else {
                            echo"<script>alert('Password Lama anda tidak sesuai')</script>";
                        }
                    }
                    ?>
                 </form>
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