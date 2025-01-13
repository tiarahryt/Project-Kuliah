<?php
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
  $id_user = intval($_GET['id_user']);
  if ($id_user > 0) {
      $sql = $conn->query("DELETE FROM tb_user WHERE id_user = $id_user") or die(mysqli_error($conn));
      if ($sql) {
          echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=anggota';</script>";
      } else {
          echo "<script>alert('Gagal menghapus data.');window.location='?p=anggota';</script>";
      }
  } else {
      echo "<script>alert('ID tidak valid.');window.location='?p=anggota';</script>";
  }
}


$id_user = $_GET['id'];

$conn->query("DELETE FROM tb_user WHERE id_user = $id_user") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=anggota';</script>";
?>