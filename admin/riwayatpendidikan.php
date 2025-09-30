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
            <h3><i class="fa fa-graduation-cap"></i> Riwayat Pendidikan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Riwayat Pendidikan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Riwayat Pendidikan</h3>
                <div class="card-tools">
                  <a href="tambahriwayatpendidikan.php" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Riwayat Pendidikan</a>
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
              <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                              <?php if(!empty($_GET['notif'])){?>
                                    <?php if($_GET['notif']=="tambahberhasil"){?>
                                        <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                                    <?php } ?>
                                  <?php }?>
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
                                    <?php } ?>
                                  <?php }?>     
                              </div>
           
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="20%">Tahun</th>
                        <th width="20%">Jenjang</th>
                        <th width="20%">Jurusan</th>
                        <th width="20%">Universitas</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    //menampilkan data
                    $sql_b = "SELECT `r`.`id_riwayat_pendidikan`,
                    `r`.`tahun`,`j`.`jenjang`, `r`.`jurusan`,
                    `u`.`nama_universitas` FROM `riwayat_pendidikan` `r`
                    INNER JOIN `master_jenjang` `j`
                    ON `r`.`id_master_jenjang` = `j`.`id_master_jenjang`
                    INNER JOIN `master_universitas` `u`
                    ON `r`.`id_master_universitas`=`u`.`id_master_universitas`
                    ORDER BY `r`.`id_riwayat_pendidikan`";
                    $query_b = mysqli_query($koneksi,$sql_b);
                    $no = 1;
                    while($data_b = mysqli_fetch_row($query_b)){
                          $id_riwayat_pendidikan = $data_b[0];
                          $tahun = $data_b[1];
                          $jenjang = $data_b[2];
                          $jurusan = $data_b[3];
                          $nama_universitas = $data_b[4];
                    ?>
                    <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $tahun;?></td>
                      <td><?php echo $jenjang;?></td>
                      <td><?php echo $jurusan;?></td>
                      <td><?php echo $nama_universitas;?></td>
                      <td align="center">
                      <a href="editriwayatpendidikan.php?data=
                      <?php echo $id_riwayat_pendidikan;?>"
                     class="btn btn-xs btn-info" title="Edit">
                     <i class="fas fa-edit"></i></a>
                        <a href="javascript:if(confirm('Anda yakin ingin
                        menghapus data <?php echo $tahun; ?>?'))
                        window.location.href =
                       'riwayatpendidikan.php?aksi=hapus&data=<?php echo
                        $id_riwayat_pendidikan;?>&notif=hapusberhasil'"
                        class="btn btn-xs btn-warning">
                        <i class="fas fa-trash" title="Hapus"></i>
                       </a>
                      </td>
                     </tr>
                    <?php $no++;}?>
                      <tr>
                        <td>1.</td>
                        <td>2019-2022</td>
                        <td>S1</td>
                        <td>Teknik Informatika</td>
                        <td>Universitas Brawijaya</td>
                        <td align="center">
                          <a href="editriwayatpendidikan.php" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="#" class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a>                         
                        </td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>2023-2025</td>
                        <td>S2</td>
                        <td>Sistem Informasi</td>
                        <td>Universitas Brawijaya</td>
                        <td align="center">
                          <a href="editriwayatpendidikan.php" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                           <a href="#" class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a>                         
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
