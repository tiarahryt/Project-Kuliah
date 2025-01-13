<?php

$conn = new mysqli("localhost", "root", "", "perpustakaan");

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

?>

<h1 class="mt-4">Data Petugas</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
  <li class="breadcrumb-item active">Data Petugas</li>
</ol>
<div class="col-md-12">
  <a href="?p=anggota&aksi=tambah" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Petugas</a>
  <a href="./laporan/laporan_petugas_excel.php" target="_blank" class="btn btn-success mb-3"><i
      class="fa fa-file-excel"></i> Export to Excel</a>
  <a href="./laporan/laporan_petugas_pdf.php" target="_blank" class="btn btn-danger mb-3"><i class="fa fa-file-pdf"></i>
    Export to PDF</a>
</div>
<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-table mr-1"></i>
    Data Petugas
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <div class="container">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jabatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php
              require_once 'config/koneksi.php';

              $data = [
                ['no' => 1, 'nama_lengkap' => 'Tiara Haryanto', 'username' => 'petugas2', 'jabatan' => 'Petugas', 'keterangan' => '-'],
                ['no' => 2, 'nama_lengkap' => 'Petugas2', 'username' => 'petugas2', 'jabatan' => 'Petugas', 'keterangan' => '-'],
                ['no' => 3, 'nama_lengkap' => 'Petugas1', 'username' => 'petugas1', 'jabatan' => 'Petugas', 'keterangan' => '-'],
              ];

              foreach ($data as $row) {
                $id_user = isset($row['id_user']) ? htmlspecialchars($row['id_user']) : '#';
                
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['no']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jabatan']) . "</td>";
                echo "<td>
                        <a href='edit_petugas.php?id=" . $id_user . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin mengedit?\")'>
                            <i class='fa fa-edit'></i> Edit
                        </a>
                        <a href='delete_petugas.php?id=" . $id_user . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>
                            <i class='fa fa-trash'></i> Delete
                        </a>
                      </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>