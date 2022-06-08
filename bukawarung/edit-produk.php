<?php 
    include 'db.php';
    session_start();
    if($_SESSION['status_login']!=true){
        header("location:login.php");
    }
    $id = $_GET['id'];
    $produk = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_id = '$id'");
    if (mysqli_num_rows($produk)==0){
        header("location:data-produk.php");
    } else {
    $p = mysqli_fetch_object($produk);
    if(isset($_POST["submit"])){
            // data inputan form
            // data gambar yang baru
            // jika admin mengganti gambar 
            // jika tidak mengganti gambar
            $kategori = $_POST['kategori'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $deskripsi = $_POST['deskripsi'];
            $status = $_POST['status'];
            $foto = $_POST['foto'];
            $filename = $_FILES['gambar']['name'];
            if($filename != ""){
                $type1 = explode(".",$filename);
                $type2 = strtolower($type1[1]); // format file
                $tipe_diizinkan = ['jpg','jpeg','png','gif'];
                $newname = 'produk'.time().'.'.$type2;
                $tmp_name = $_FILES['gambar']['tmp_name'];
                if (!(in_array($type2, $tipe_diizinkan))) {
                    echo"<script>alert(`Format file tidak diizinkan`)</script>";
                } else {
                    unlink('./produk/'.$foto);
                    move_uploaded_file($tmp_name,'./produk/'.$newname);
                    $namagambar = $newname;
                }
            } else {
                $namagambar = $foto;
            }
            // query update data produk
            $update = mysqli_query($conn,"UPDATE tb_product SET 
                                    category_id='$kategori',
                                    product_name='$nama',
                                    product_price='$harga',
                                    product_description='$deskripsi',
                                    product_image='$namagambar',
                                    product_status='$status' WHERE product_id='$id'");
            if($update){
                echo"<script>alert('simpan data berhasil'); document.location.href ='data-produk.php'; </script>";
            } else {
                echo'gagal'.mysqli_error($conn);
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
             <h3>Edit Data Produk</h3>
             <div class="box">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <label for="Kategori">Kategori</label>
                     <select name="kategori" class="input-control" required>
                         <option value="">--Pilih--</option>
                         <?php 
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while ($r = mysqli_fetch_array($kategori)) {
                         ?>
                         <option value="<?php echo $r['category_id']?>" <?php echo($r['category_id']==$p->category_id)?'selected':' ';  ?>><?php echo $r["category_name"]  ?></option>
                         <?php }  ?>
                     </select>
                     <label for="nama">Nama Produk</label>
                     <input type="text" name="nama" class="input-control" placeholder="Nama Produk" require value="<?php echo $p->product_name?>">
                     <label for="harga">Harga</label>
                     <input type="text" name="harga" class="input-control" placeholder="Harga" required value="<?php echo $p->product_price?>">
                     <img src="produk/<?php echo $p->product_image?>" alt="" width="150px" height="150px"style="border-radius:50%;">
                     <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                     <input type="file" name="gambar" class="input-control">
                     <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"><?php echo $p->product_description?></textarea>
                     <br>
                     <label for="status">Status</label>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo($p->product_status==1)?'selected':'';  ?>>Aktif</option>
                        <option value="0" <?php echo($p->product_status==0)?'selected':'';  ?>>Tidak Aktif</option>
                    </select>
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>