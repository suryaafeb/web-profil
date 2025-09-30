<?php
include('koneksi/koneksi.php');

// jika button kirim pesan diklik
if (isset($_POST['kirim'])) {
    // amankan inputan agar tidak terkena SQL Injection
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $id_topik = mysqli_real_escape_string($koneksi, $_POST['topik']);
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    $sql_i = "INSERT INTO `kontak` (`nama`, `email`, `id_topik`, `pesan`)
              VALUES ('$nama', '$email', '$id_topik', '$pesan')";

    if (mysqli_query($koneksi, $sql_i)) {
        header("Location: index.php?notif=kirimberhasil");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
