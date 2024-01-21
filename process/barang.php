<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

if(isset($_POST['tambah'])){
    $nama_barang = $_POST['nama_barang'];
    $penulis_id = $_POST['penulis_id'];
    $kategori_id = $_POST['kategori_id'];
    $hargajual = $_POST['hargajual'];
	$hargabeli = $_POST['hargabeli'];
    $stok = 0;

    $insert = mysqli_query($con,"INSERT INTO barang (penulis_id, kategori_id, nama_barang, hargabeli, hargajual, stok) VALUES ('$penulis_id','$kategori_id','$nama_barang','$hargabeli','$hargajual','$stok')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data barang';
    }else{
        $error = 'Gagal menambahkan data barang';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?barang');
}

if(isset($_POST['ubah'])){
    $id = $_POST['idbarang'];
    $penulis_id = $_POST['penulis_id'];
    $kategori_id = $_POST['kategori_id'];
    $nama_barang = $_POST['nama_barang'];
	$hargabeli = $_POST['hargabeli'];
    $hargajual = $_POST['hargajual'];

    $update = mysqli_query($con,"UPDATE barang SET penulis_id='$penulis_id', kategori_id='$kategori_id', nama_barang='$nama_barang', hargabeli='$hargabeli', hargajual='$hargajual' WHERE idbarang='$id'") or die (mysqli_error($con));
    
    // var_dump($update);die;
    if($update){
        $success = 'Berhasil mengubah data barang';
    }else{
        $error = 'Gagal mengubah data barang';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?barang');
}

if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    // echo $_GET['act'];die;
    $id = decrypt($_GET['id']);
    $delete = mysqli_query($con, "DELETE FROM barang WHERE idbarang='$id'")or die(mysqli_error($con));
    if ($delete) {
        $success = "Data barang berhasil dihapus";
    }else{
        $error = "Data barang gagal dihapus";
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?barang');
}
?>