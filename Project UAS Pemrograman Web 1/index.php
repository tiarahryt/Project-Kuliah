<?php
session_start();
require_once 'config/koneksi.php';

if ($conn->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}
echo "Koneksi berhasil!";

$page = @$_GET['p'];
$aksi = @$_GET['aksi'];

if ($page == 'halaman_petugas') {
  include 'halaman_petugas.php';
} 
?>
<!-- <pre>
<?php var_dump($_SESSION['login']);  ?>
</pre> -->
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
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Data</div>
            <a class="nav-link" href="?p=anggota">
              <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
              Data Petugas
            </a>
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
        <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <?php

        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }

        if (isset($_SESSION['login'])) {
          $nama = $_SESSION['login']['nama'];
        } else {
          $nama = "Pengguna";
        }
        ?>
        <marquee behavior="scroll" class="btn btn-dark">
          Selamat Datang <b><?= htmlspecialchars($nama); ?></b>
          Perpustakaan Online 2025</marquee>
        <div class="container-fluid">
          <!-- <h1 class="mt-4">Static Navigation</h1> -->
          <?php

          if ($page == 'buku') {
            if ($aksi == '') {
              require_once 'page/buku/buku.php';
            } else if ($aksi == 'tambah') {
              require_once 'page/buku/tambah.php';
            } else if ($aksi == 'ubah') {
              require_once 'page/buku/ubah.php';
            } else if ($aksi == 'hapus') {
              require_once 'page/buku/hapus.php';
            } elseif ($aksi == 'deskripsi') {
              require_once 'page/buku/deskripsi.php';
            }
          } else if ($page == 'anggota') {
            if ($aksi == '') {
              require_once 'page/anggota/anggota.php';
            } else if ($aksi == 'tambah') {
              require_once 'page/anggota/tambah.php';
            } else if ($aksi == 'ubah') {
              require_once 'page/anggota/ubah.php';
            } else if ($aksi == 'hapus') {
              require_once 'page/anggota/hapus.php';
            }
          } else if ($page == 'transaksi') {
            if ($aksi == '') {
              require_once 'page/transaksi/transaksi.php';
            } else if ($aksi == 'tambah') {
              require_once 'page/transaksi/tambah.php';
            } else if ($aksi == 'kembali') {
              require_once 'page/transaksi/kembali.php';
            } else if ($aksi == 'perpanjang') {
              require_once 'page/transaksi/perpanjang.php';
            }
          } else { ?>

          <title>Dashboard</title>
          <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
          }

          .dashboard {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f4f8;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          }

          .dashboard h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
          }

          .dashboard p {
            text-align: center;
            color: #555;
          }

          .list-container {
            margin-top: 20px;
            padding: 15px;
            border: 2px solid #d9d9d9;
            border-radius: 8px;
            background-color: #ffffff;
          }

          .list-container ul {
            list-style-type: square;
            padding-left: 20px;
            color: #333;
          }

          .list-container ul li {
            margin-bottom: 10px;
          }
          </style>
          </head>

          <body>

            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">

              <p>Perpustakaan Online Berbasis Website dengan menggunakan PHP Native. Website ini dibuat dengan
                menggunakan HTML, CSS, PHP, JavaScript, dan menggunakan DBMS (MySQL).</p>

              <div class="list-container">
                <ul>
                  <li>Fitur pengelola admin website.</li>
                  <li>CRUD Buku.</li>
                  <li>CRUD Anggota.</li>
                  <li>Fitur "kembali" buku yang sudah dipinjam.</li>
                  <li>Login, Registrasi, Transaksi, dan Logout.</li>
                </ul>

                <?php
              }
                ?>

              </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <!-- <div class="text-muted">Copyright &copy; Your Website 2025</div> -->
            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="js/scripts.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
  <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
  <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>