<?php
include('../koneksi/koneksi.php');
?>

<?php
include('../koneksi/koneksi.php');
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
if($_GET['aksi']=='hapus'){
$id_master_universitas = $_GET['data'];
//hapus universitas
$sql_dh = "delete from `master_universitas`
where `id_master_universitas` = '$id_master_universitas'";
mysqli_query($koneksi,$sql_dh);
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
<?php


?>
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-universitas"></i> Universitas</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Universitas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(isset($_GET['notif']) && $_GET['notif'] == "editberhasil") { ?>
        <div class="alert alert-success" role="alert">
          Data Berhasil Diubah
      </div>
      <?php } ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Universitas</h3>
                <div class="card-tools">
                  <a href="tambahuniversitas.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah  Universitas</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
              <?php if(!empty($_GET['notif'])){?>
                  <?php if($_GET['notif']=="tambahkosong"){?>
                  <div class="alert alert-danger" role="alert">
                  Maaf data universitas wajib di isi</div>
                  <?php }?>
               <?php }?>
                  <form method="get" action="universitas.php">
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
                      <th width="80%">Universitas</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
//hitung jumlah semua data
$batas = 2;
$sql_jum = "SELECT `id_master_universitas`, `nama_universitas` FROM master_universitas";

if (isset($_GET["katakunci"])) {
  $katakunci_universitas = $_GET["katakunci"];
  $sql_jum .= " WHERE `nama_universitas` LIKE '%$katakunci_universitas%'";
}

$sql_jum .= " ORDER BY `nama_universitas`";
$query_jum = mysqli_query($koneksi,$sql_jum);
$jum_data = mysqli_num_rows($query_jum);
$jum_halaman = ceil($jum_data/$batas);
?>
<?php
                  
if(!isset($_GET['halaman'])){
$posisi = 0;
$halaman = 1;
}else{
$halaman = $_GET['halaman'];
$posisi = ($halaman-1) * $batas;
}
$no = $posisi+1;

// Definisi query dulu
$sql_u = "SELECT `id_master_universitas`,`nama_universitas` FROM
`master_universitas` ";
if (isset($_GET["katakunci"])){
$katakunci_universitas = $_GET["katakunci"];
$sql_u .= " where `nama_universitas` LIKE
'%$katakunci_universitas%'";
}
$sql_u .= "ORDER BY `nama_universitas` limit $posisi, $batas ";
// Baru eksekusi query
$query_u = mysqli_query($koneksi, $sql_u);
while($data_u = mysqli_fetch_array($query_u)){
?>
<tr>
  <td><?php echo $no; ?></td>
  <td><?php echo $data_u['nama_universitas']; ?></td>
  <td align="center">
   <a href="edituniversitas.php?id=<?php echo $data_u['id_master_universitas']; ?>" 
   class="btn btn-info btn-sm">
   <i class="fas fa-edit"></i> Edit
</a>
<a href="universitas.php?aksi=hapus&data=<?php echo $data_u['id_master_universitas']; ?>" 
   onclick="return confirm('Hapus data?')" 
   class="btn btn-warning btn-sm">
   <i class="fas fa-trash"></i> Hapus
</a>
    
  </td>
</tr>
<?php
  $no++;
} // <-- ini penting, buat nutup while-nya
?>
<ul class="pagination pagination-sm m-0 float-right">
<?php
if($jum_halaman==0){
//tidak ada halaman
}else if($jum_halaman==1){
echo "<li class='page-item'><a class='page-link'>1</a></li>";
}else{
$sebelum = $halaman-1;
$setelah = $halaman+1;
if (isset($_GET["katakunci"])){
$katakunci_universitas = $_GET["katakunci"];
if($halaman!=1){
echo "<li class='page-item'>
<a class='page-link'
href='universitas.php?katakunci=
$katakunci_universitas
&halaman=1'>First</a></li>";
echo "<li class='page-item'><a class='page-link'
href='universitas.php?katakunci
=$katakunci_universitas&

halaman=$sebelum'>
«</a></li>";
}
for($i=1; $i<=$jum_halaman; $i++){
if ($i > $halaman - 5 and $i < $halaman + 5 ) {
if($i!=$halaman){
echo "<li class='page-item'><a class='page-link'
href='universitas.php?katakunci
=$katakunci_universitas&halaman=$i'>
$i</a></li>";
}else{
echo "<li class='page-item'>
<a class='page-link'>$i</a></li>";
}
}
}
if($halaman!=$jum_halaman){
echo "<li class='page-item'>
<a class='page-link'
href='universitas.php?katakunci
=$katakunci_universitas
&halaman=$setelah'>»</a></li>";
echo "<li class='page-item'><a class='page-link'
href='universitas.php?katakunci=
$katakunci_universitas&halaman=$jum_halaman'>
Last</a></li>";
}
}else{
if($halaman!=1){
echo "<li class='page-item'><a class='page-link'
href='universitas.php?halaman=1'>First</a></li>";
echo "<li class='page-item'><a class='page-link'
href='universitas.php?
halaman=$sebelum'>«</a></li>";
}
for($i=1; $i<=$jum_halaman; $i++){
if ($i > $halaman - 5 and $i < $halaman + 5 ) {
if($i!=$halaman){
echo "<li class='page-item'><a class='page-link'
href='universitas.php?halaman=$i'>$i</a></li>";
}else{
echo "<li class='page-item'><a class='page-link'>$i</a></li>";
}
}
}
if($halaman!=$jum_halaman){
echo "<li class='page-item'><a class='page-link'
href='universitas.php?halaman=$setelah'>
»</a></li>";
echo "<li class='page-item'><a class='page-link'
href='kategoribuku.php?
halaman=$jum_halaman'>Last</a></li>";
}
}
}?>
</ul>
</div>
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
