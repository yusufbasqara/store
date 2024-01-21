<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

//proses tambah
if(isset($_POST['tambah'])){
    $barang_id = $_POST['barang_id'];
    $jumlah = $_POST['jumlah'];
    $hargabeli = $_POST['hargabeli'];
    $hargajual = $_POST['hargajual'];
    $tanggal = $_POST['tanggal'];

    $insert = mysqli_query($con,"INSERT INTO barang_keluar (barang_id, jumlah, hargabeli, hargajual, tanggal) VALUES ('$barang_id','$jumlah','$hargabeli','$hargajual','$tanggal')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data barang keluar';
    }else{
        $error = 'Gagal menambahkan data barang keluar';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?barang_keluar');
}

//proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM barang_keluar WHERE idbarang_keluar='$id'")or die(mysqli_error($con));
    if($query){
        $success = 'Berhasil menghapus data barang keluar';
    }else{
        $error = 'Gagal menghapus data barang keluar';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?barang_keluar');
}

?>
