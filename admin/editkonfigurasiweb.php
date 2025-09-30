<?php
session_start();
include('../koneksi/koneksi.php');

if(isset($_GET['data'])){
  $id_konfigurasi = $_GET['data'];
  $_SESSION['id_konfigurasi']=$id_konfigurasi;

  //get data konfigurasi web
  $sql_k = "SELECT logo, nama_web, tahun
            FROM konfigurasi_web
            WHERE id_konfigurasi='$id_konfigurasi'";
  $query_k = mysqli_query($koneksi, $sql_k);

  while($data_k = mysqli_fetch_row($query_k)){
    $logo = $data_k[0];
    $nama_web = $data_k[1];
    $tahun = $data_k[2];
  }
}
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
            <h3><i class="fas fa-edit"></i> Edit Konfigurasi Web</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="konfigurasiweb.php">Konfigurasi Web</a></li>
              <li class="breadcrumb-item active">Edit Konfigurasi Web</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Konfigurasi Web</h3>
        <div class="card-tools">
          <a href="konfigurasiweb.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <div class="col-sm-10">
          <div class="alert alert-danger" role="alert">Maaf data nama wajib di isi</div>
      </div>
      <div class="col-sm-10">
<?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){?>
<?php if($_GET['notif']=="editkosong"){?>
<div class="alert alert-danger" role="alert">Maaf data
<?php echo $_GET['jenis'];?> wajib di isi</div>
<?php }?>
<?php }?>
</div>
      <form class="form-horizontal" action="konfirmasiupdatekonfigurasi.php" method="post" enctype="multipart/form-data">
  <div class="card-body">

    <!-- Logo -->
    <div class="form-group row">
      <label for="logo" class="col-sm-3 col-form-label">Logo</label>
      <div class="col-sm-7">
        <?php if(!empty($logo)){?>
          <img src="gambar/<?php echo $logo;?>" class="mb-2" style="max-height: 80px;">
        <?php }?>
        <input type="file" class="form-control" name="logo" id="logo">
      </div>
    </div>

    <!-- Nama Web -->
    <div class="form-group row">
      <label for="nama_web" class="col-sm-3 col-form-label">Nama Web</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="nama_web" id="nama_web"
        value="<?php echo $nama_web;?>">
      </div>
    </div>

    <!-- Tahun -->
    <div class="form-group row">
      <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="tahun" id="tahun"
        value="<?php echo $tahun;?>">
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
