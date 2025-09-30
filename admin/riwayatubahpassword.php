<?php
session_start();
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
          <h3><i class="fas fa-key"></i> Ubah Password</h3>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Form Pengaturan Password</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?php if(isset($_GET['notif'])){ 
          if($_GET['notif']=="kosong"){
            $jenis = $_GET['jenis'];
            echo "<div class='alert alert-danger'>Maaf, password $jenis wajib diisi.</div>";
          } else if($_GET['notif']=="konfirmasigagal"){
            echo "<div class='alert alert-danger'>Konfirmasi password baru tidak cocok.</div>";
          } else if($_GET['notif']=="salah"){
            echo "<div class='alert alert-danger'>Password lama yang Anda masukkan salah.</div>";
          } else if($_GET['notif']=="berhasil"){
            echo "<div class='alert alert-success'>Password berhasil diubah.</div>";
          }
        } ?>

        <form class="form-horizontal" action="konfirmasiubahpassword.php" method="post">
          <div class="form-group row">
            <label for="password_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" name="password_lama" id="password_lama">
            </div>
          </div>
          <div class="form-group row">
            <label for="password_baru" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" name="password_baru" id="password_baru">
            </div>
          </div>
          <div class="form-group row">
            <label for="konfirmasi_password" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
            </div>
          </div>
          <div class="card-footer">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<!-- ./wrapper -->
<?php include("includes/script.php") ?>
</body>
</html>