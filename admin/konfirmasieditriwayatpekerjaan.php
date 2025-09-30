<?php
session_start();
include('../koneksi/koneksi.php');

if(isset($_SESSION['id_riwayat_pekerjaan'])){
  $id_riwayat_pekerjaan = $_SESSION['id_riwayat_pekerjaan'];
  $tahun = $_POST['tahun'];
  $posisi = $_POST['posisi'];
  $id_master_perusahaan = $_POST['perusahaan'];

  if(empty($tahun)){
    header("Location:editriwayatpekerjaan.php?data=$id_riwayat_pekerjaan&notif=editkosong&jenis=tahun");
  } else if(empty($posisi)){
    header("Location:editriwayatpekerjaan.php?data=$id_riwayat_pekerjaan&notif=editkosong&jenis=posisi");
  } else if(empty($id_master_perusahaan)){
    header("Location:editriwayatpekerjaan.php?data=$id_riwayat_pekerjaan&notif=editkosong&jenis=perusahaan");
  } else {
    $sql = "UPDATE `riwayat_pekerjaan` SET 
            `tahun`='$tahun',
            `posisi`='$posisi',
            `id_master_perusahaan`='$id_master_perusahaan'
            WHERE `id_riwayat_pekerjaan`='$id_riwayat_pekerjaan'";
    
    mysqli_query($koneksi, $sql);
    header("Location:riwayatpekerjaan.php?notif=editberhasil");
  }
}
?>