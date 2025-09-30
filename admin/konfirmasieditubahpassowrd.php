<?php
session_start();
include('../koneksi/koneksi.php');

if(isset($_SESSION['id_admin'])){
  $id_admin = $_SESSION['id_admin'];
  $password_lama = $_POST['password_lama'];
  $password_baru = $_POST['password_baru'];
  $konfirmasi_password = $_POST['konfirmasi_password'];

  // Validasi form kosong
  if(empty($password_lama)){
    header("Location:ubahpassword.php?notif=kosong&jenis=lama");
  } else if(empty($password_baru)){
    header("Location:ubahpassword.php?notif=kosong&jenis=baru");
  } else if(empty($konfirmasi_password)){
    header("Location:ubahpassword.php?notif=kosong&jenis=konfirmasi");
  } else if($password_baru != $konfirmasi_password){
    header("Location:ubahpassword.php?notif=konfirmasigagal");
  } else {
    // Cek password lama
    $sql = "SELECT `password` FROM `admin` WHERE `id_admin`='$id_admin'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);

    if(md5($password_lama) == $data['password']){
      // Update password baru
      $password_baru_md5 = md5($password_baru);
      $sql_update = "UPDATE `admin` SET `password`='$password_baru_md5' WHERE `id_admin`='$id_admin'";
      mysqli_query($koneksi, $sql_update);
      header("Location:ubahpassword.php?notif=berhasil");
    } else {
      header("Location:ubahpassword.php?notif=salah");
    }
  }
}
?>