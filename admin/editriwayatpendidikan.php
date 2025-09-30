<?php
session_start();
include('../koneksi/koneksi.php');
if(isset($_GET['data'])){
  $id_blog = $_GET['data'];
  $_SESSION['id_blog']=$id_blog;
  //get data blog
  $sql_m = "SELECT `id_kategori_blog`,`judul`,`isi`, DATE_FORMAT(`tanggal`,'%d-%m-%Y')
  FROM `blog` WHERE `id_blog`='$id_blog'";
  $query_m = mysqli_query($koneksi,$sql_m);
  while($data_m = mysqli_fetch_row($query_m)){
    $id_kategori_blog= $data_m[0];
    $judul = $data_m[1];
    $isi = $data_m[2];
    $tanggal = $data_m[3];
}
//get tag

$sql_h = "select `id_tag` from `tag_blog`
     where `id_blog`='$id_blog'";
$query_h = mysqli_query($koneksi,$sql_h);
$array_tag = array();
while($data_h = mysqli_fetch_row($query_h)){
   $id_tag= $data_h[0];
   $array_tag[] = $id_tag;
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
            <h3><i class="fas fa-edit"></i> Edit Data Riwayat Pendidikan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="riwayatpendidikan.php">Data Riwayat Pendidikan</a></li>
              <li class="breadcrumb-item active">Edit Data Riwayat Pendidikan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Riwayat Pendidikan</h3>
        <div class="card-tools">
          <a href="riwayatpendidikan.php" class="btn btn-sm btn-warning float-right">
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
                <?php if($_GET['notif']=="editkosong"){?>
                  <div class="alert alert-danger" role="alert">Maaf data
                  <?php echo $_GET['jenis'];?> wajib di isi</div>
                <?php }?>
                <?php }?>
      </div>
      <form class="form-horizontal" action="konfirmasieditriwayatpendidikan.php" method="post">
        <div class="card-body">
          <div class="form-group row">
            <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun;?>">
            </div>
          </div>          
          <div class="form-group row">
            <label for="jenjang" class="col-sm-3 col-form-label">Jenjang Pendidikan</label>
            <div class="col-sm-7">
              <select class="form-control" id="jenjang" name="jenjang">
              <option value="">- Pilih Jenjang Pendidikan -</option>
              <?php
              $sql_j = "SELECT `id_master_jenjang`,`jenjang` FROM
             `master_jenjang` ORDER BY `id_master_jenjang`";
              $query_j = mysqli_query($koneksi, $sql_j);
              while($data_j = mysqli_fetch_row($query_j)){
                    $id_master_jenjang = $data_j[0];
                    $jenjang = $data_j[1];
              ?>
              <option value="<?php echo $id_master_jenjang;?>"
              <?php if($id_master_jenjang==$ID_MasterJenjang){?>
              selected<?php }?>>
               <?php echo $jenjang;?></option>
              <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="jurusan" id="jurusan" value="<?php echo $jurusan;?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="universitas" class="col-sm-3 col-form-label">Universitas</label>
            <div class="col-sm-7">
              <select class="form-control" id="universitas" name="universitas">
                <option value="0">- Pilih Universitas -</option>
                <?php
                $sql_u = "SELECT `id_master_universitas`,`nama_universitas` FROM
                `master_universitas` ORDER BY `nama_universitas`";
                $query_u = mysqli_query($koneksi, $sql_u);
                while($data_u = mysqli_fetch_row($query_u)){
                      $id_master_universitas = $data_u[0];
                      $nama_universitas = $data_u[1];
                ?>
                <option value="<?php echo $id_master_universitas;?>"
                <?php if($id_master_universitas==$ID_MasterUniversitas){?>
                selected<?php }?>>
                <?php echo $nama_universitas;?></option>
                <?php }?>
              </select>
            </div>
          </div>
          
          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
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
