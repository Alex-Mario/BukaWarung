<?php 
    include "db.php";
    if (isset($_GET['idk'])) {
        $id = $_GET['idk'];
        $kategori=mysqli_query($conn,"SELECT category_image FROM tb_category WHERE category_id='$id'");
        $k = mysqli_fetch_object($kategori);
        unlink('./kategori/'.$k->category_image);
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id='$id'");
        echo "<script>alert('hapus kategori berhasil'); document.location.href ='data-kategori.php'</script>";
    }
    if(isset($_GET['idp'])){
        $id = $_GET['idp'];
        $produk = mysqli_query($conn,"SELECT product_image FROM tb_product WHERE product_id='$id'");
        $p = mysqli_fetch_object($produk);
        unlink('./produk/'.$p->product_image);
        $delete =  mysqli_query($conn, "DELETE FROM tb_product WHERE product_id='$id'");
        echo "<script>alert('hapus produk berhasil'); document.location.href ='data-produk.php'; </script>";
    }

?>