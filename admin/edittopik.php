<?php
session_start();
include('../koneksi/koneksi.php');
if(isset($_GET['data'])){

$id_master_topik = $_GET['data'];
$_SESSION['id_master_topik']=$id_master_topik;
//get data topik
$sql_d = "select `topik` from `master_topik` where
`id_master_topik` = '$id_master_topik'";
$query_d = mysqli_query($koneksi,$sql_d);
while($data_d = mysqli_fetch_row($query_d)){
$topik = $data_d[0];
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
            <h3><i class="fas fa-edit"></i> Edit Topik</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="topik.php">Topik</a></li>
              <li class="breadcrumb-item active">Edit Topik</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Topik</h3>
        <div class="card-tools">
          <a href="topik.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <div class="col-sm-10">
          <div class="alert alert-danger" role="alert">Maaf data Topik wajib di isi</div>
      </div>
      <?php if(!empty($_GET['notif'])){?>
        <?php if($_GET['notif']=="editkosong"){?>
           <div class="alert alert-danger" role="alert">
           Maaf data soft_skill wajib di isi</div>
        <?php }?>
      <?php }?>
      <form class="form-horizontal"method="post"
      action="konfirmasiedituniversitas.php">
        <div class="card-body">
          <div class="form-group row">
            <label for="Topik" class="col-sm-3 col-form-label">Topik</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="Topik" name="topik" value="<?php echo $topik;?>">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
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
