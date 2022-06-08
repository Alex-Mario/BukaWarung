<?php 
    include 'db.php';
    session_start();
    if($_SESSION['status_login']!=true){
        header("location:login.php");
    }
        $id = $_GET['id'];
        $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '$id'");        
        if(mysqli_num_rows($kategori)===0){
            echo "<script>document.location.href ='data-kategori.php'; </script>";
        } else {
            $k = mysqli_fetch_object($kategori);
            if(isset($_POST["submit"])){
                $nama = ucwords($_POST["nama"]);
                $foto = $_POST['foto'];
                $filename = $_FILES['gambar']['name'];
                if($filename != ""){
                    $type1 = explode(".",$filename);
                    $type2 = strtolower($type1[1]); // format file
                    $tipe_diizinkan = ['jpg','jpeg','png','gif'];
                    $newname = 'gambar kategori '.$nama.'.'.$type2;
                    $tmp_name = $_FILES['gambar']['tmp_name'];
                    if (!(in_array($type2, $tipe_diizinkan))) {
                        echo"<script>alert(`Format file tidak diizinkan`)</script>";
                    } else {
                        unlink('./kategori/'.$foto);
                        move_uploaded_file($tmp_name,'./kategori/'.$newname);
                        $namagambar = $newname;
                    }
                } else {
                    $namagambar = $foto;
                }
                $update = "UPDATE tb_category SET category_name = '$nama', category_image='$namagambar' WHERE category_id = '$id'";
                $query = mysqli_query($conn,$update);
                if ($query) {
                    echo"<script>alert('simpan data berhasil'); document.location.href ='data-kategori.php'; </script>";
                } else {
                    echo"gagal".mysqli_error($conn);
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
             <h3>Edit Data Category</h3>
             <div class="box">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="foto" value="<?php echo $k->category_image ?>">
                     <label for="name">Kategori</label>    
                     <input type="text" name="nama" placeholder="Nama Kategori" class="input-control"  required value="<?php echo $k->category_name?>">
                     <label for="gambar">Gambar Kategori</label> 
                     <br>
                     <br>
                     <img src="kategori/<?php echo $k->category_image?>" alt="">
                     <br>
                     <br>
                     <input type="file" name="gambar">
                     <br>
                     <br>
                     <button type="submit" name="submit" class="btn">Submit</button>
                    
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