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
            <h3><i class="fa fa-envelope-o"></i> Kontak</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Kontak</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Kontak</h3>
                <div class="card-tools">
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
<?php } ?>
<?php }?>
</div>
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama</th>
                        <th width="20%">Email</th>
                        <th width="10%">Topik</th>
                        <th width="30%">Pesan</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
// Menampilkan data kontak
$sql_k = "SELECT id_kontak, nama, email, topik, pesan 
          FROM kontak 
          ORDER BY id_kontak";
$query_k = mysqli_query($koneksi, $sql_k);
$no = 1;
while($data_k = mysqli_fetch_row($query_k)){
  $id_kontak = $data_k[0];
  $nama = $data_k[1];
  $email = $data_k[2];
  $topik = $data_k[3];
  $pesan = $data_k[4];
?>
<tr>
  <td><?php echo $no;?></td>
  <td><?php echo $nama;?></td>
  <td><?php echo $email;?></td>
  <td><?php echo $topik;?></td>
  <td><?php echo $pesan;?></td>
  <td align="center">
    <a href="javascript:if(confirm('Anda yakin ingin menghapus data kontak <?php echo $nama; ?>?')) 
      window.location.href='kontak.php?aksi=hapus&data=<?php echo $id_kontak;?>&notif=hapusberhasil'" 
      class="btn btn-xs btn-warning" title="Hapus">
      <i class="fas fa-trash"></i>
    </a>
  </td>
</tr>
<?php $no++; } ?>
                      
                      <tr>
                        <td>2.</td>
                        <td>Nova Ela</td>
                        <td>nova@gmail.com</td>
                        <td>Kritik</td>
                        <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </td>
                        <td align="center">
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
