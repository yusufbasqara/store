<?php
function session_timeout(){
    //lama waktu 30 menit = 1800
    if(isset($_SESSION['LAST_ACTIVITY'])&&(time()-$_SESSION['LAST_ACTIVITY']>1800)){
        session_unset();
        session_destroy();
        header("Location:".$base_url."login.php");
    }$_SESSION['LAST_ACTIVITY']=time();
}
function delMask( $str ) {
    return (int)implode('',explode('.',$str));
}
function hakAkses( array $a){
    $akses = $_SESSION['level'];
    if(!in_array($akses,$a)){
        // header('Location:?');
        echo '<script>window.location = "?#";</script>';
    }
}
function bulan($bln){
    $bulan = [
        1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

    return $bulan[$bln];
}
function tahun(){
    return [
        '2020','2021','2022','2023','2024','2025'
    ];
}

function list_penulis(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM penulis ORDER BY nama_penulis ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['idpenulis']."\">".$row['nama_penulis']."</option>";
    }  
    return $opt; 
}

function list_kategori(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM kategori ORDER BY nama_kategori ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['idkategori']."\">".$row['nama_kategori']."</option>";
    }  
    return $opt; 
}

function list_barang(){
    include ('conn.php');
    $kategori = mysqli_query($con,"SELECT * FROM kategori ORDER BY nama_kategori ASC");
    $opt = "";
    while($row = mysqli_fetch_array($kategori)){
        $barang = mysqli_query($con,"SELECT x.*,x1.nama_penulis FROM barang x JOIN penulis x1 ON x1.idpenulis=x.penulis_id WHERE kategori_id='".$row['idkategori']."' ORDER BY nama_barang ASC");
        $opt .= "<optgroup label=\"".$row['nama_kategori']." | ".$row['harga jual']."\">";
        while($row2 = mysqli_fetch_array($barang)){
            $opt .= "<option value=\"".$row2['idbarang']."\">".$row2['nama_barang']." - ".$row2['nama_penulis']."</option>";
        }
        $opt .= "</optgroup>";
    }  
    return $opt; 
}

function encrypt($str) {
return base64_encode($str);
}
function decrypt($str) {
return base64_decode($str);
}

function base_url(){
    $base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url.= "://".$_SERVER['HTTP_HOST'];
    $base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    return $base_url;
}
?>