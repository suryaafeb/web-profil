<?php
include('../koneksi/koneksi.php');
session_start();
if(isset($_SESSION['id_user'])){
$id_user = $_SESSION['id_user'];
$sql_d = "select `nama`, `email`,`deskripsi` from `user`
where `id_user` = '$id_user'";
$query_d = mysqli_query($koneksi,$sql_d);
while($data_d = mysqli_fetch_row($query_d)){
$nama= $data_d[0];
$email= $data_d[1];
$deskripsi = $data_d[2];
}
//get soft skill
$sql_ss = "SELECT `id_master_soft_skill` FROM `soft_skill`
where `id_user`='$id_user'";
$query_ss = mysqli_query($koneksi,$sql_ss);
$array_ss = array();
while($data_ss = mysqli_fetch_row($query_ss)){
$ID_SoftSkill= $data_ss[0];
$array_ss[] = $ID_SoftSkill;
}
//get hard skill
$sql_hs = "SELECT `id_master_hard_skill` FROM `hard_skill`
where `id_user`='$id_user'";
$query_hs = mysqli_query($koneksi,$sql_hs);
$array_hs = array();
while($data_hs = mysqli_fetch_row($query_hs)){
$ID_HardSkill= $data_hs[0];
$array_hs[] = $ID_HardSkill;
}

}
?>

<?php
include('../koneksi/koneksi.php');
session_start();
$nama='';
$email='';
$foto='';
$deskripsi='';
if(isset($_SESSION['id_user'])){
  $id_user = $_SESSION['id_user'];
  $sql_d = "SELECT `nama`, `email`, `foto`, `deskripsi` FROM `user`
            WHERE `id_user` = '$id_user'";
  $query_d = mysqli_query($koneksi, $sql_d);
  while($data_d = mysqli_fetch_array($query_d)){
    $nama = $data_d['nama'];
    $email = $data_d['email'];
    $foto = $data_d['foto'];
    $deskripsi = $data_d['deskripsi'];
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

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3><i class="fas fa-edit"></i> Edit Profil</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="profil.php">Profil</a></li>
            <li class="breadcrumb-item active">Edit Profil</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Profil</h3>
        <div class="card-tools">
          <a href="profil.php" class="btn btn-sm btn-warning float-right">
            <i class="fas fa-arrow-alt-circle-left"></i> Kembali
          </a>
        </div>
      </div>

      <div class="card-body">
        <?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){?>
          <?php if($_GET['notif']=="editkosong"){?>
            <div class="alert alert-danger" role="alert">Maaf data <?php echo $_GET['jenis'];?> wajib di isi
            </div>
          <?php }?>
        <?php }?>

        <form class="form-horizontal" method="post" action="konfirmasieditprofil.php" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="foto" class="col-sm-12 col-form-label">
              <span class="text-info">
                <i class="fas fa-user-circle"></i> <u>PROFIL USER</u>
              </span>
            </label>
          </div>

          <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Foto Pegawai</label>
            <div class="col-sm-7">
              <div class="custom-file">
                <img src="foto/Neva.jpg" alt="Foto pegawai" class="img-fluid" width="150" height="150">
                <input type="file" class="custom-file-input" name="foto" id="customFile">
                <label class="custom-file-label" for="customFile"></label>
              </div>  
            </div>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="deskripsi" id="editor1" rows="6"><?php echo $deskripsi;?></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label for="softskill" class="col-sm-3 col-form-label">Soft Skill</label>
            <div class="col-sm-7">
            <label for="softskill" class="col-sm-3 col-form-label">
Soft Skill</label>
<div class="col-sm-7">
<?php
$sql_s = "SELECT `id_master_soft_skill`,`soft_skill`

FROM `master_soft_skill`

ORDER BY `id_master_soft_skill`";
$query_s = mysqli_query($koneksi, $sql_s);
while($data_s = mysqli_fetch_row($query_s)){
$id_ss = $data_s[0];
$ss = $data_s[1];
?>
<input type="checkbox" name="soft_skill[]"

value="<?php echo $id_ss;?>"

<?php if(in_array($id_ss, $array_ss)){?>checked="checked"
<?php }?>> <?php echo $ss;?></br>
<?php }?>
            </div>
          </div>

          <div class="form-group row">
            <label for="hardskill" class="col-sm-3 col-form-label">Hard Skill</label>
            <div class="col-sm-7">
            <?php
$sql_h = "SELECT `id_master_hard_skill`,`hard_skill`

FROM `master_hard_skill`

ORDER BY `id_master_hard_skill`";
$query_h = mysqli_query($koneksi, $sql_h);
while($data_h = mysqli_fetch_row($query_h)){
$id_hs = $data_h[0];
$hs = $data_h[1];
?>
<input type="checkbox" name="hard_skill[]"

value="<?php echo $id_hs;?>"

<?php if(in_array($id_hs, $array_hs)){?>checked="checked"
<?php }?>> <?php echo $hs;?></br>

<?php }?>
</div>
</div>
            </div>
          </div>

          <div class="card-footer">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-info float-right">
                <i class="fas fa-save"></i> Simpan
              </button>
            </div>  
          </div>

        </form>
      </div>
    </div>
  </section>
</div>

<?php include("includes/footer.php") ?>
</div>

<?php include("includes/script.php") ?>
</body>
</html>