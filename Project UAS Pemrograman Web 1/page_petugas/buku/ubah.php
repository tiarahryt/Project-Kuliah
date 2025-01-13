<?php

$id_buku = $_GET['id'];

$sql = $conn->query("SELECT * FROM tb_buku WHERE id_buku = $id_buku") or die(mysqli_error($conn));
$pecahSql = $sql->fetch_assoc();

$tahun = $pecahSql['tahun_terbit'];

if (isset($_POST['ubah'])) {
    $judul = htmlspecialchars($_POST['judul_buku']);
    $pengarang = htmlspecialchars($_POST['pengarang_buku']);
    $penerbit = htmlspecialchars($_POST['penerbit_buku']);
    $tahun_terbit = htmlspecialchars($_POST['tahun_terbit']);
    $isbn = htmlspecialchars($_POST['isbn']);
    $jumlah = htmlspecialchars($_POST['jumlah_buku']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);

    if (empty($judul && $pengarang && $penerbit && $tahun_terbit && $isbn && $jumlah && $kategori && $tgl_input)) {
        echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=buku';</script>";
    }

    $sql = $conn->query("UPDATE tb_buku SET judul_buku = '$judul', pengarang_buku = '$pengarang', penerbit_buku = '$penerbit', tahun_terbit = '$tahun_terbit', isbn = '$isbn', jumlah_buku = '$jumlah', kategori = '$kategori', tgl_input = '$tgl_input' WHERE id_buku = $id_buku") or die(mysqli_error($conn));
    if ($sql) {
        echo "<script>alert('Data Berhasil Diubah.');window.location='?p=buku';</script>";
    } else {
        echo "<script>alert('Data Gagal Diubah.');window.location='?p=buku';</script>";
    }
}

?>

<h1 class="mt-4">Ubah Data Buku</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="halaman_petugas.php">Dashboard</a></li>
  <li class="breadcrumb-item active">Ubah Data Buku</li>
</ol>
<div class="card-header mb-5">

  <form action="" method="post">
    <div class="form-group">
      <label class="small mb-1" for="judul_buku">Judul Buku</label>
      <input class="form-control" id="judul_buku" name="judul_buku" type="text" placeholder="Masukan judul buku"
        value="<?= $pecahSql['judul_buku']; ?>" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="pengarang_buku">Pengarang</label>
      <input class="form-control" id="pengarang_buku" name="pengarang_buku" type="text"
        value="<?= $pecahSql['pengarang_buku']; ?>" placeholder="Masukan pengarang buku" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="penerbit_buku">Penerbit</label>
      <input class="form-control" id="penerbit_buku" name="penerbit_buku" type="text"
        value="<?= $pecahSql['penerbit_buku']; ?>" placeholder="Masukan penerbit buku" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="tahun_terbit">Tahun Terbit</label>
      <select name="tahun_terbit" id="tahun_terbit" class="form-control">
        <option value="">-- Pilih Tahun --</option>
        <?php
                $tahun = date('Y');
                for ($i = $tahun - 29; $i <= $tahun; $i++) { ?>
        <option value="<?= $i ?>" <?php if ($pecahSql['tahun_terbit'] == $i) {
                                                    echo "selected";
                                                } ?>><?= $i ?></option>
        <?php
                }
                ?>
      </select>
    </div>
    <div class="form-group">
      <label class="small mb-1" for="isbn">Deskripsi</label>
      <textarea class="form-control" id="isbn" name="isbn" type="text"
        placeholder="Masukan isbn buku"><?= $pecahSql['isbn']; ?></textarea>
    </div>
    <div class="form-group">
      <label class="small mb-1" for="jumlah_buku">Jumlah Buku</label>
      <input class="form-control" value="<?= $pecahSql['jumlah_buku']; ?>" id="jumlah_buku" name="jumlah_buku"
        type="number" placeholder="Masukan jumlah buku" />
    </div>
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" class="form-control">
        <option value="">-- Pilih Kategori --</option>
        <option value="Novel" <?php if (trim($pecahSql['kategori']) == 'Novel') {
                                            echo "selected";
                                        } ?>>Novel</option>
        <option value="Cerpen" <?php if (trim($pecahSql['kategori']) == 'Cerpen') {
                                            echo "selected";
                                        } ?>>Cerpen</option>
        <option value="Biografi" <?php if (trim($pecahSql['kategori']) == 'Biografi') {
                                                echo "selected";
                                            } ?>>Biografi</option>

      </select>
    </div>
    <div class="form-group">
      <label for="tgl_input">Tanggal Input</label>
      <input type="date" name="tgl_input" id="tgl_input" class="form-control" value="<?= $pecahSql['tgl_input']; ?>">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="ubah">Ubah Data</button>
    </div>
  </form>
</div>