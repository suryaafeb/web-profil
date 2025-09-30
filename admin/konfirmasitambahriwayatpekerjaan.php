<?php
session_start();
include('../koneksi/koneksi.php');

$tahun = $_POST['tahun'];
$posisi = $_POST['posisi'];
$id_master_perusahaan = $_POST['perusahaan'];

if(empty($tahun)){
  header("Location:tambahriwayatpekerjaan.php?notif=tambahkosong&jenis=tahun");
} else if(empty($posisi)){
  header("Location:tambahriwayatpekerjaan.php?notif=tambahkosong&jenis=posisi");
} else if(empty($id_master_perusahaan)){
  header("Location:tambahriwayatpekerjaan.php?notif=tambahkosong&jenis=perusahaan");
} else {
  $sql = "INSERT INTO `riwayat_pekerjaan`
          (`tahun`, `posisi`, `id_master_perusahaan`)
          VALUES
          ('$tahun', '$posisi', '$id_master_perusahaan')";
  mysqli_query($koneksi, $sql);
  
  header("Location:riwayatpekerjaan.php?notif=tambahberhasil");
}
?>