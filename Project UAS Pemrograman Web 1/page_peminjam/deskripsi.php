<?php

$id_buku = $_GET['id'];

$sql = $conn->query("SELECT * FROM tb_buku WHERE id_buku = $id_buku") or die(mysqli_error($conn));
$pecahSql = $sql->fetch_assoc();

$tahun = $pecahSql['tahun_terbit'];

?>

<h1 class="mt-4">Deskripsi</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="halaman_peminjam.php">Dashboard</a></li>\
  <li class="breadcrumb-item active">Deskripsi</li>
</ol>
<div class="card-header mb-5">

  <form action="" method="post">
    <div class="form-group mb-4">
      <label for="judul_buku" class="h4 mb-0">Judul Buku:</label>
      <h3 class="mt-2"><?= $pecahSql['judul_buku']; ?></h3>
    </div>

    <div class="row">
      <div class="col-md-2 form-group mb-4">
        <label for="pengarang_buku" class="h5">Pengarang</label>
        <p><strong><?= $pecahSql['pengarang_buku']; ?></strong></p>
      </div>

      <div class="col-md-6 form-group mb-4">
        <label for="penerbit_buku" class="h5">Penerbit</label>
        <p><strong><?= $pecahSql['penerbit_buku']; ?></strong></p>
      </div>
    </div>

    <div class="mb-4">
      <?php if (!empty($pecahSql['foto'])): ?>
      <img src="img/<?= $pecahSql['foto']; ?>" alt="Sampul Buku" class="img-fluid" style="max-width: 200px;">
      <?php else: ?>
      <span>Tidak ada gambar</span>
      <?php endif; ?>
    </div>

    <div class="form-group mb-4">
      <label for="isbn" class="h4">Deskripsi Buku:</label>
      <p><?= $pecahSql['isbn']; ?></p>
    </div>
  </form>

</div>