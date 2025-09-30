<?php
include('../koneksi/koneksi.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM master_universitas WHERE id_master_universitas='$id'";
    mysqli_query($koneksi, $sql);
    header("Location:universitas.php?notif=hapusberhasil");
}
?>