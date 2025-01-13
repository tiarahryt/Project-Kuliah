<?php
require_once 'config/koneksi.php';

function uploadFoto()
{
    $namaFoto = $_FILES['foto']['name'];
    $ukuranFoto = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpFoto = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu.');</script>";
        return false;
    }

    $fotoValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFoto = explode('.', $namaFoto);
    $ekstensiFoto = strtolower(end($ekstensiFoto));

    if (!in_array($ekstensiFoto, $fotoValid)) {
        echo "<script>alert('Yang anda upload bukan gambar.');</script>";
        return false;
    }

    if ($ukuranFoto > 2000000) {
        echo "<script>alert('Ukuran gambar terlalu besar. Maksimal 2MB');</script>";
        return false;
    }

    $fileNameBaru = uniqid();
    $fileNameBaru .= '.';
    $fileNameBaru .= $ekstensiFoto;

    if (!is_dir('img')) {
        mkdir('img');
    }

    move_uploaded_file($tmpFoto, 'img/' . $fileNameBaru);
    return $fileNameBaru;
}

if (isset($_POST['tambah'])) {
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
        exit();
    }

    $foto = uploadFoto();
    if (!$foto) {
        exit();
    }

    $sql = $conn->query("INSERT INTO tb_buku (judul_buku, pengarang_buku, penerbit_buku, tahun_terbit, isbn, jumlah_buku, kategori, tgl_input, foto) 
                         VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$isbn', '$jumlah', '$kategori', '$tgl_input', '$foto')")
        or die(mysqli_error($conn));

    if ($sql) {
        echo "<script>alert('Data Berhasil Ditambahkan.');window.location='?p=buku';</script>";
    } else {
        echo "<script>alert('Data Gagal Ditambahkan.')</script>";
    }
}
?>


<h1 class="mt-4">Tambah Data Buku</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="halaman_petugas.php">Dashboard</a></li>
  <li class="breadcrumb-item active">Tambah Data Buku</li>
</ol>
<div class="card-header mb-5">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="small mb-1" for="judul_buku">Judul</label>
      <input class="form-control" id="judul_buku" name="judul_buku" type="text" placeholder="Masukkan judul buku" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="pengarang_buku">Pengarang</label>
      <input class="form-control" id="pengarang_buku" name="pengarang_buku" type="text"
        placeholder="Masukkan pengarang buku" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="penerbit_buku">Penerbit</label>
      <input class="form-control" id="penerbit_buku" name="penerbit_buku" type="text"
        placeholder="Masukkan penerbit buku" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="tahun_terbit">Tahun Terbit</label>
      <select name="tahun_terbit" id="tahun_terbit" class="form-control">
        <option value="">-- Pilih Tahun --</option>
        <?php
                $tahun = date('Y');
                for ($i = $tahun - 29; $i <= $tahun; $i++) { ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label class="small mb-1" for="isbn">Deskripsi</label>
      <textarea class="form-control" name="isbn" id="isbn" type="text" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label class="small mb-1" for="jumlah_buku">Jumlah Buku</label>
      <input class="form-control" id="jumlah_buku" name="jumlah_buku" type="number"
        placeholder="Masukkan jumlah buku" />
    </div>
    <!-- <div class="form-group">
            <label for="kategori">Kategori</label>
            <input class="form-control" id="kategori" name="kategori" type="text" placeholder="Masukkan kategori buku">
        </div> -->
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" class="form-control">
        <option value="">-- Pilih kategori --</option>
        <option value="Novel">Novel</option>
        <option value="Cerpen">Cerpen</option>
        <option value="Biografi">Biografi</option>
      </select>
    </div>
    <div class="form-group">
      <label for="tgl_input">Tanggal Input</label>
      <input type="date" name="tgl_input" id="tgl_input" class="form-control">
    </div>
    <div class="form-group">
      <label class="small" for="foto">Upload Sampul Buku</label>
      <input class="form-control-file" id="foto" name="foto" type="file" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
  </form>
</div>