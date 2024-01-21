<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');
//proses tambah
if(isset($_POST['tambah'])){
    $nama_penulis = $_POST['nama_penulis'];
	$hargabeli = $_POST['hargabeli'];
    $hargajual = $_POST['hargajual'];

    
    $insert = mysqli_query($con,"INSERT INTO penulis (nama_penulis, hargabeli, hargajual) VALUES ('$nama_penulis','$hargabeli','$hargajual')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data penulis';
    }else{
        $error = 'Gagal menambahkan data penulis';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?penulis');
}
//proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM penulis WHERE idpenulis='$id'")or die(mysqli_error($con));
    if($query){
        $success = 'Berhasil menghapus data penulis';
    }else{
        $error = 'Gagal menghapus data penulis';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?penulis');
}

?>