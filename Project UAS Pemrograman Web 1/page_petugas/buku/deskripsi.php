<?php

$id_buku = $_GET['id'];

$sql = $conn->query("SELECT * FROM tb_buku WHERE id_buku = $id_buku") or die(mysqli_error($conn));
$pecahSql = $sql->fetch_assoc();

$tahun = $pecahSql['tahun_terbit'];

?>

<h1 class="mt-4">Deskripsi</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="halaman_petugas.php">Dashboard</a></li>\
  <li class="breadcrumb-item active">Deskripsi</li>
</ol>

<div class="card-header mb-5">
  <form action="" method="post">
    <div class="form-group mb-4">
      <h4 class="mb-1" for="judul_buku">Judul:</h4>
      <h3 class="mt-2"><?= $pecahSql['judul_buku']; ?></h3>
    </div>

    <div class="mb-4">
      <?php if (!empty($pecahSql['foto'])): ?>
      <img src="img/<?= $pecahSql['foto']; ?>" alt="Sampul Buku" width="150" class="img-fluid">
      <?php else: ?>
      <span>Tidak ada gambar</span>
      <?php endif; ?>
    </div>

    <div class="form-group mb-4">
      <h4 class="mb-1" for="isbn">Deskripsi Buku:</h4>
      <p class="mt-2"><?= $pecahSql['isbn']; ?></p>
    </div>
  </form>

</div>