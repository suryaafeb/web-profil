<?php
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
            <h3><i class="fas fa-plus"></i> Tambah Riwayat Pekerjaan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="riwayatpekerjaan.php">Data Riwayat Pekerjaan</a></li>
              <li class="breadcrumb-item active">Tambah Riwayat Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Riwayat Pekerjaan</h3>
        <div class="card-tools">
          <a href="riwayatpekerjaan.php" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
          <div class="alert alert-danger" role="alert">Maaf tahun wajib di isi</div>
      </div>
      <div class="col-sm-10">
<?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){?>
<?php if($_GET['notif']=="tambahkosong"){?>
<div class="alert alert-danger" role="alert">Maaf data
<?php echo $_GET['jenis'];?> wajib di isi</div>
<?php }?>
<?php }?>
</div>
      <form class="form-horizontal" action="konfirmasitambahriwayatpekerjaan.php" method="post">
  <div class="card-body">
  
    <div class="form-group row">
      <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="tahun" id="tahun" value="">
      </div>
    </div>

    <div class="form-group row">
      <label for="posisi" class="col-sm-3 col-form-label">Posisi</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="posisi" id="posisi" value="">
      </div>
    </div>

    <div class="form-group row">
      <label for="perusahaan" class="col-sm-3 col-form-label">Perusahaan</label>
      <div class="col-sm-7">
        <select class="form-control" id="perusahaan" name="perusahaan">
          <option value="">- Pilih Perusahaan -</option>
          <?php
          $sql_p = "SELECT `id_master_perusahaan`, `nama_perusahaan` FROM `master_perusahaan` ORDER BY `nama_perusahaan`";
          $query_p = mysqli_query($koneksi, $sql_p);
          while($data_p = mysqli_fetch_row($query_p)){
            $id_master_perusahaan = $data_p[0];
            $nama_perusahaan = $data_p[1];
          ?>
          <option value="<?php echo $id_master_perusahaan;?>">
            <?php echo $nama_perusahaan;?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>

  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-info float-right">
        <i class="fas fa-plus"></i> Tambah
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
