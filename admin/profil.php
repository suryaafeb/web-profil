<?php
include('../koneksi/koneksi.php');
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
if($_GET['aksi']=='hapus'){
$id_riwayat_pendidikan = $_GET['data'];
//hapus data
$sql_dp = "DELETE from `riwayat_pendidikan`
where `id_riwayat_pendidikan` = '$id_riwayat_pendidikan'";
mysqli_query($koneksi,$sql_dp);
}
}
?>
<?php
session_start();
include('../koneksi/koneksi.php');
$id_user = $_SESSION['id_user'] = 1;

$nama = '';
$email = '';
$foto = '';
//get profil
$sql = "select `nama`, `email`,`foto` from `user`
 where `id_user`='$id_user'";
 //echo $sql;
$query = mysqli_query($koneksi, $sql);
while($data = mysqli_fetch_row($query)){
       $nama = $data[0];
       $email = $data[1];
       $foto = $data[2];
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
            <h3><i class="fas fa-user-tie"></i> Profil</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <a href="editprofil.php" class="btn btn-sm btn-info float-right"><i class="fas fa-edit"></i> Edit Profil</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-sm-12">
                    <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                </div>
                <?php if(!empty($_GET['notif'])){
                    if($_GET['notif']=="editberhasil"){?>
                         <div class="alert alert-success" role="alert">
                         Data Berhasil Diubah</div>
                    <?php }?>
                <?php }?>
                <table class="table table-bordered">
                    <tbody>  
                      <tr>
                        <td colspan="2"><i class="fas fa-user-circle"></i> <strong>PROFIL<strong></td>
                      </tr> 
                      <tr>
                        <td width="20%"><strong>Foto<strong></td>
                        <td width="80%"><img src="foto/<?php echo $foto;?>" class="img-fluid" width="200px;"></td>
                      </tr>                
                      <tr>
                        <td width="20%"><strong>Nama<strong></td>
                        <td width="80%"><?php echo $nama; ?></td>
                      </tr>                
                      <tr>
                        <td width="20%"><strong>Email<strong></td>
                        <td width="80%"><?php echo $email; ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Deskripsi<strong></td>
                        <td width="80%">Saya adalah seorang profesional dengan pengalaman di bidang TI. Saya memiliki berbagai keterampilan baik soft skill maupun hard skill yang mendukung karir saya.</td>
                      </tr>
                      <tr>
                      <td width="20%"><strong>Soft Skill<strong></td>
                      <td width="80%">
                      <ul>
                        <?php
                        $sql_ss = "SELECT `ms`.`soft_skill` FROM `master_soft_skill` `ms`
                                  INNER JOIN `soft_skill` `s`
                                  ON `ms`.`id_master_soft_skill` = `s`.`id_master_soft_skill`
                                  WHERE `s`.`id_user`='$id_user'";
                        $query_ss = mysqli_query($koneksi,$sql_ss);
                        while($data_ss = mysqli_fetch_row($query_ss)){
                            $soft_skill = $data_ss[0];
                       ?>
                              <li><?php echo $soft_skill;?></li>
                       <?php }?>
                       </ul>
                      </td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Hard Skill<strong></td>                     
                        <td width="80%">
                        <ul>
                        <?php
                        $sql_hs = "SELECT `mh`.`hard_skill` FROM `master_hard_skill` `mh`
                                  INNER JOIN `hard_skill` `h`
                                 ON `mh`.`id_master_hard_skill` = `h`.`id_master_hard_skill`
                                 WHERE `h`.`id_user`='$id_user'";
                        $query_hs = mysqli_query($koneksi,$sql_hs);
                        while($data_hs = mysqli_fetch_row($query_hs)){
                             $hard_skill = $data_hs[0];
                        ?>
                             <li><?php echo $hard_skill;?></li>
                        <?php }?>
                        </ul>
                        </td>
                      </tr> 
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">&nbsp;</div>
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
