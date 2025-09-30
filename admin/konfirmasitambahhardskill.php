<?php
include('../koneksi/koneksi.php');
$hard_skill = $_POST['hard_skill'];
if(empty($hard_skill)) {
    header("Location:tambahhardskill.php?notif=tambahkosong");
}else{
    $sql = "insert into `master_hard_skill` (`hard_skill`)
    values ('$hard_skill')";
    mysqli_query($koneksi,$sql);
    header("location:hardskill.php?notif=tambahberhasil");
}
?>