<?php
session_start();
include('../koneksi/koneksi.php');

// Ambil data dari form
$nama_web = $_POST['nama_web'];
$tahun = $_POST['tahun'];

// ambil logo lama dulu
$sql_logo = "SELECT `logo` FROM `konfigurasi_web`";
$query_logo = mysqli_query($koneksi, $sql_logo);
$data_logo = mysqli_fetch_row($query_logo);
$logo_lama = $data_logo[0];

// Cek upload file logo
if(!empty($_FILES['logo']['name'])){
    $lokasi_file = $_FILES['logo']['tmp_name'];
    $nama_file = $_FILES['logo']['name'];
    $direktori = "gambar/$nama_file";

    // hapus logo lama kalau ada
    if(!empty($logo_lama) && file_exists("gambar/$logo_lama")){
        unlink("gambar/$logo_lama");
    }

    // upload logo baru
    move_uploaded_file($lokasi_file, $direktori);

    // update konfigurasi dengan logo baru
    $sql = "UPDATE `konfigurasi_web` 
            SET `logo`='$nama_file', `nama_web`='$nama_web', `tahun`='$tahun'";
} else {
    // update tanpa ganti logo
    $sql = "UPDATE `konfigurasi_web` 
            SET `nama_web`='$nama_web', `tahun`='$tahun'";
}

// Jalankan query
mysqli_query($koneksi, $sql);

// Redirect ke halaman konfigurasi
header("Location:konfigurasiview.php?notif=editberhasil");
?>