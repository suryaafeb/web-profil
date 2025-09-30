<?php
session_start();
include('../koneksi/koneksi.php');

// pastikan admin login
if(isset($_SESSION['id_admin'])){
    $id_admin = $_SESSION['id_admin'];

    // ambil data dari form
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // validasi kosong
    if(empty($password_lama)){
        header("Location:ubahpassword.php?notif=editkosong&jenis=passwordlama");
    } else if(empty($password_baru)){
        header("Location:ubahpassword.php?notif=editkosong&jenis=passwordbaru");
    } else if(empty($konfirmasi_password)){
        header("Location:ubahpassword.php?notif=editkosong&jenis=konfirmasi");
    } else if($password_baru != $konfirmasi_password){
        header("Location:ubahpassword.php?notif=editkosong&jenis=konfirmasisalah");
    } else {
        // cek password lama
        $sql = "SELECT `password` FROM `admin` WHERE `id_admin`='$id_admin'";
        $query = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_row($query);

        if(md5($password_lama) == $data[0]){
            // update password baru
            $password_baru_md5 = md5($password_baru);
            $sql_update = "UPDATE `admin` SET `password`='$password_baru_md5' WHERE `id_admin`='$id_admin'";
            mysqli_query($koneksi, $sql_update);

            // redirect sukses
            header("Location:ubahpassword.php?notif=editberhasil");
        } else {
            // password lama salah
            header("Location:ubahpassword.php?notif=editkosong&jenis=passwordlamasalah");
        }
    }
}
?>
<?php
// ubahpassword.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../koneksi/koneksi.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-user-lock"></i> Ubah Password</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Ubah Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Pengaturan Password</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <?php
?>

<div class="col-sm-10">
<?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){?>
<?php if($_GET['notif']=="editkosong"){?>
<div class="alert alert-danger" role="alert">Maaf data
<?php echo $_GET['jenis'];?> wajib di isi</div>
<?php }?>
<?php }?>
</div>
<!-- HTML & Form Ubah Password -->
<form class="form-horizontal" action="konfirmasiubahpassword.php" method="post">
  <div class="card-body">

    <div class="form-group row">
      <label for="password_lama" class="col-sm-3 col-form-label">Password Lama</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukkan Password Lama">
      </div>
    </div>

    <div class="form-group row">
      <label for="password_baru" class="col-sm-3 col-form-label">Password Baru</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru">
      </div>
    </div>

    <div class="form-group row">
      <label for="konfirmasi_password" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Ulangi Password Baru">
      </div>
    </div>

  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-info float-right">
        <i class="fas fa-save"></i> Simpan
      </button>
    </div>
  </div>
  <!-- /.card-footer -->
</form>
      <?php if(!empty($notif)){ echo "<div class='alert alert-info'>$notif</div>"; } ?>
      <button type="submit" name="simpan" class="btn btn-info">Simpan</button>
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
