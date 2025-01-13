<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];
$ambilBuku = $conn->query("SELECT * FROM pinjaman WHERE id_user = '$id_user' ORDER BY nama DESC") or die(mysqli_error($conn));
?>

<h1 class="mt-4">Data Buku</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="halaman_petugas.php">Dashboard</a></li>
  <li class="breadcrumb-item active">Data Buku</li>
</ol>
<div class="col-md-6">
  <a href="halaman_peminjam.php" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Buku</a>
</div>
<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-table mr-1"></i>
    Keranjang Buku
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Sampul</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php
                    $no = 1;
                    while ($pecahBuku = $ambilBuku->fetch_assoc()) {

                    ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $pecahBuku['judul_buku']; ?></td>
            <td>
              <?php if (!empty($pecahBuku['foto'])): ?>
              <img src="img/<?= $pecahBuku['foto']; ?>" alt="Sampul Buku" width="50">
              <?php else: ?>
              <span>Tidak ada gambar</span>
              <?php endif; ?>
            </td>

            <td>
              <a href="?p=buku&aksi=deskripsi&id=<?= $idBuku; ?>" class="btn btn-primary btn-sm">👁️ Kembalikan</a>
              <a href="?p=buku&aksi=hapus&id=<?= $idBuku; ?>" class="btn btn-danger btn-sm">🗑️ Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>