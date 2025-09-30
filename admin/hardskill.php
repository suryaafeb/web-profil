<?php
include('../koneksi/koneksi.php');
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
if($_GET['aksi']=='hapus'){
$id_master_hard_skill = $_GET['data'];
//hapus hard skill
$sql_dh = "delete from `master_hard_skill`
where `id_master_hard_skill` = '$id_master_hard_skill'";
mysqli_query($koneksi,$sql_dh);
}
}
?>

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
            <h3><i class="fas fa-hardskill"></i> Hard Skill</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Hard Skill</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Hard Skill</h3>
                <div class="card-tools">
                  <a href="tambahhardskill.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah  Hard Skill</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="" action="">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
                  <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                  
              </div>
              <div class="col-sm-12">
                 <?php if(!empty($_GET['notif'])){?>
                    <?php if($_GET['notif']=="tambahberhasil"){?>
                    <div class="alert alert-success" role="alert">
                    Data Berhasil Ditambahkan</div>
                    <?php }?>
                  <?php }?>

                  <div class="col-sm-12">         
                 <?php if(!empty($_GET['notif'])){?>
                    <?php if($_GET['notif']=="tambahberhasil"){?>
                          <div class="alert alert-success" role="alert">
                          Data Berhasil Ditambahkan</div>
                    <?php } else if($_GET['notif']=="editberhasil"){?>
                          <div class="alert alert-success" role="alert">
                          Data Berhasil Diubah</div>
                    <?php } else if($_GET['notif']=="hapusberhasil"){?>
                          <div class="alert alert-success" role="alert">
                          Data Berhasil Dihapus</div>
                  <?php }?>
                 <?php }?>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="80%">Hard Skill</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql_u = "SELECT `id_master_hard_skill`,`hard_skill` FROM
              `master_hard_skill` ORDER BY `hard_skill`";
                  $query_u = mysqli_query($koneksi,$sql_u);
                  $no = 1;
                  while($data_u = mysqli_fetch_row($query_u)){
                     $id_master_hard_skill = $data_u[0];
                     $hard_skill = $data_u[1];
                  ?>
                  <tr>
                     <td><?php echo $no;?></td>
                     <td><?php echo $hard_skill;?></td>
                     <td align="center">
                     <a href="edithardskill.php?data=<?php echo
                     $id_master_hard_skill;?>"
                     class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                     <a href="javascript:if(confirm('Anda yakin ingin menghapus data
                     <?php echo $hard_skill; ?>?'))window.location.href =
                     'hardskill.php?aksi=hapus&data=<?php echo
                      $id_master_hard_skill;?>&notif=hapusberhasil'"
                      class="btn btn-xs btn-warning"><i class="fas fa-trash"></i>
                      Hapus</a>
                   </td>
                   </tr>
                   <?php $no++;}?>
                    <tr>
                      <td>1.</td>
                      <td>HTML, CSS, JavaScript</td>
                      <td align="center">
                        <a href="edithardskill.php" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>PHP, Python</td>
                      <td align="center">
                        <a href="edithardskill.php" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
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
