<?php
include('../koneksi/koneksi.php');

if((isset($_GET['aksi'])) && (isset($_GET['data']))){
  if($_GET['aksi'] == 'hapus'){
    $id_riwayat_pekerjaan = $_GET['data'];
    // hapus data
    $sql_dp = "DELETE FROM `riwayat_pekerjaan` 
               WHERE `id_riwayat_pekerjaan` = '$id_riwayat_pekerjaan'";
    mysqli_query($koneksi, $sql_dp);
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
            <h3><i class="fa fa-suitcase"></i> Riwayat Pekerjaan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Riwayat Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Riwayat Pekerjaan</h3>
                <div class="card-tools">
                  <a href="tambahriwayatpekerjaan.php" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Riwayat Pekerjaan</a>
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

              <div class="col-sm-12">

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
</div>
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="20%">Tahun</th>
                        <th width="30%">Posisi</th>
                        <th width="30%">Perusahaan</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    <tbody>
<?php
// Menampilkan data
$sql_p = "SELECT id_riwayat_pekerjaan, tahun, posisi, perusahaan 
          FROM riwayat_pekerjaan 
          ORDER BY id_riwayat_pekerjaan";
$query_p = mysqli_query($koneksi, $sql_p);
$no = 1;
while($data_p = mysqli_fetch_row($query_p)) {
    $id_riwayat_pekerjaan = $data_p[0];
    $tahun = $data_p[1];
    $posisi = $data_p[2];
    $perusahaan = $data_p[3];
?>
<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $tahun; ?></td>
    <td><?php echo $posisi; ?></td>
    <td><?php echo $perusahaan; ?></td>
    <td align="center">
        <a href="editriwayatpekerjaan.php?data=<?php echo $id_riwayat_pekerjaan;?>" 
           class="btn btn-xs btn-info" title="Edit">
           <i class="fas fa-edit"></i>
        </a>
        <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $tahun; ?>?')) 
           window.location.href = 'riwayatpekerjaan.php?aksi=hapus&data=<?php echo $id_riwayat_pekerjaan;?>'" 
           class="btn btn-xs btn-danger" title="Hapus">
           <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>
<?php $no++; } ?>
</tbody>
                     
                    
                      
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
