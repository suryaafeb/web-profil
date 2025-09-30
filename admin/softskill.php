<?php
include('../koneksi/koneksi.php');
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
if($_GET['aksi']=='hapus'){
$id_master_soft_skill = $_GET['data'];
//hapus soft skill
$sql_dh = "delete from `master_soft_skill`
where `id_master_soft_skill` = '$id_master_soft_skill'";
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
            <h3><i class="fas fa-softskill"></i> Soft Skill</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Soft Skill</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Soft Skill</h3>
                <div class="card-tools">
                  <a href="tambahsoftskill.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah  Soft Skill</a>
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
                    <?php } else if($_GET['notif']=="editberhasil"){?>
                          <div class="alert alert-success" role="alert">
                          Data Berhasil Diubah</div>
                    <?php } else if($_GET['notif']=="hapusberhasil"){?>
                          <div class="alert alert-success" role="alert">
                          Data Berhasil Dihapus</div>
                  <?php }?>
                 <?php }?>


              </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="80%">Soft Skill</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql_s = "SELECT `id_master_soft_skill`,`soft_skill` FROM `master_soft_skill` ORDER BY `soft_skill`";
                    $query_s = mysqli_query($koneksi,$sql_s);
                    $no = 1;
                    while($data_s = mysqli_fetch_row($query_s)){
                      $id_master_soft_skill = $data_s [0];
                      $soft_skill = $data_s[1];
                    ?>
                    <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $soft_skill;?></td>
                      <td align="center">
                        <a href="editsoftskill.php?data=<?php echo
                        $id_master_soft_skill;?>"
                        class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data
                        <?php echo $soft_skill; ?>?'))window.location.href =
                        'softskill.php?aksi=hapus&data=<?php echo
                        $id_master_soft_skill;?>&notif=hapusberhasil'"
                        class="btn btn-xs btn-warning"><i class="fas fa-trash"></i>
                        Hapus</a>
                    </td>
                    </tr>
                    <?php $no++;}?>
                    </tbody>
                    </table>
                    <tr>
                      <td>1.</td>
                      <td>Komunikasi</td>
                      <td align="center">
                        <a href="editsoftskill.php" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Kepemimpinan</td>
                      <td align="center">
                        <a href="editsoftskill.php" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
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
