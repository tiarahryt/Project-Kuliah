<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$page = @$_GET['p'];
$aksi = @$_GET['aksi'];

$query = "SELECT id_user AS no, nama_lengkap, username, level AS jabatan, CONCAT('Keterangan untuk ', nama_lengkap) AS keterangan FROM tb_user";
$result = $conn->query($query);

if (!$result) {
  die("Error: " . $conn->error);
}

?>

<?php var_dump($_SESSION['login']);  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>
    <?php
    if ($page == 'buku') {
      if ($aksi == 'tambah') {
        echo "Tambah Buku";
      } else if ($aksi == 'ubah') {
        echo "Ubah Buku";
      } else {
        echo "Halaman Buku";
      }
    } else if ($page == 'anggota') {
      if ($aksi == 'tambah') {
        echo "Tambah Anggota";
      } else if ($aksi == 'ubah') {
        echo "Ubah Anggota";
      } else {
        echo "Halaman Anggota";
      }
    } else if ($page == 'transaksi') {
      if ($aksi == 'tambah') {
        echo "Tambah Transaksi";
      } else {
        echo "Halaman Transaksi";
      }
    } else {
      echo "Dashboard";
    }

    ?>
  </title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    .container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 12px 15px;
      text-align: left;
      border: 1px solid #ddd;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e9ecef;
    }

    .btn {
      padding: 10px 20px;
      margin: 10px 0;
      display: inline-block;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>

  <link href="css/styles.css" rel="stylesheet" />
  <script src="js/fontawesomeall.min.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Perpustakaan</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
        class="fas fa-bars"></i></button>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
          aria-describedby="basic-addon2" />
        <div class="input-group-append">
          <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>

    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Aktivitas Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">


            <div class="sb-sidenav-menu-heading">Menu</div>
            <a class="nav-link" href="halaman_petugas.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard Petugas
            </a>

            <div class="container">
              <h1>Data Petugas</h1>

              <a href="tambah_petugas.php" class="btn">Tambah Petugas</a>

              <table>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['no']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['jabatan']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="sb-sidenav-menu-heading">Data</div>
            <a class="nav-link" href="?p=buku">
              <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
              Data Buku
            </a>
            <a class="nav-link" href="?p=transaksi">
              <div class="sb-nav-link-icon"><i class="fa fa-handshake" aria-hidden="true"></i></div>
              Transaksi
            </a>
          </div>
        </div>

      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <marquee behavior="scroll" class="btn btn-dark">Selamat Datang di<b><?= $_SESSION['login']['nama']; ?></b>
          Perpustakaan Online 2025</marquee>
        <div class="container-fluid">

          <?php

          if ($page == 'buku') {
            if ($aksi == '') {
              require_once 'page_petugas/buku/buku.php';
            } else if ($aksi == 'tambah') {
              require_once 'page_petugas/buku/tambah.php';
            } else if ($aksi == 'ubah') {
              require_once 'page_petugas/buku/ubah.php';
            } else if ($aksi == 'hapus') {
              require_once 'page_petugas/buku/hapus.php';
            } elseif ($aksi == 'deskripsi') {
              require_once 'page_petugas/buku/deskripsi.php';
            }
          } else if ($page == 'transaksi') {
            if ($aksi == '') {
              require_once 'page/transaksi/transaksi.php';
            } else if ($aksi == 'table') {
              require_once 'page/transaksi/tambah.php';
            } else if ($aksi == 'kembali') {
              require_once 'page/transaksi/kembali.php';
            } else if ($aksi == 'perpanjang') {
              require_once 'page/transaksi/perpanjang.php';
            }
          } else { ?>
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          <?php
          }
          ?>

        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="js/scripts.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>