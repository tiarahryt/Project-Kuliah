<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$page = @$_GET['p'];
$aksi = @$_GET['aksi']; 

$ambilBuku = $conn->query("SELECT * FROM tb_buku ORDER BY id_buku DESC") or die(mysqli_error($conn));

if (isset($_POST['tambah'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['id_user']; 

    $ambilBuku = $conn->query("SELECT judul_buku, foto FROM tb_buku WHERE id_buku='$id_buku'");
    $dataBuku = $ambilBuku->fetch_assoc();

    $ambilUser = $conn->query("SELECT nama, id_user FROM tb_user WHERE id_user='$id_user'");
    $dataUser = $ambilUser->fetch_assoc();
    $conn->query("INSERT INTO pinjaman (judul_buku, foto, id_user ,nama) VALUES ('{$dataBuku['judul_buku']}', '{$dataBuku['foto']}', '{$dataUser['id_user']}','{$dataUser['nama']}')");
    echo "<script>alert('Buku berhasil dipinjam!');window.location='?=Dashboard'</script>";
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            <a class="nav-link" href="halaman_peminjam.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard peminjam
            </a>
            <div class="sb-sidenav-menu-heading">Data</div>
            <a class="nav-link" href="?p=transaksi">
              <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
              Buku yang dipinjam
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
        <marquee behavior="scroll" class="btn btn-dark">
          Selamat Datang di<b>
            <?= $_SESSION['login']['nama'] ?? 'Pengguna'; ?>
          </b> Perpustakaan Online 2025
        </marquee>
        <div class="container-fluid">
          <!-- <h1 class="mt-4">Static Navigation</h1> -->
          <?php

                    if ($page == 'buku') {
                        if ($aksi == '') {
                            require_once 'page_peminjam/buku/buku.php';
                        } else if ($aksi == 'tambah') {
                            require_once 'page_petugas/buku/tambah.php';
                        } else if ($aksi == 'ubah') {
                            require_once 'page_petugas/buku/ubah.php';
                        } else if ($aksi == 'hapus') {
                            require_once 'page_petugas/buku/hapus.php';
                        } elseif ($aksi == 'deskripsi') {
                            require_once 'page_peminjam/deskripsi.php';
                        }
                    } else if ($page == 'transaksi') {
                        if ($aksi == '') {
                            require_once 'page_peminjam/keranjang/buku.php';
                        } else if ($aksi == 'tambah') {
                            require_once 'page/transaksi/tambah.php';
                        } else if ($aksi == 'kembali') {
                            require_once 'page/transaksi/kembali.php';
                        } else if ($aksi == 'perpanjang') {
                            require_once 'page/transaksi/perpanjang.php';
                        }
                    } else { ?>
          <h1 class="mt-4">Dashboard</h1>
          <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item"><a href="halaman_petugas.php">Dashboard</a></li> -->
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table mr-1"></i>
              Data Buku
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
                        <img src="img/<?= $pecahBuku['foto']; ?>" alt="Sampul Buku" width="100">
                        <?php else: ?>
                        <span>Tidak ada gambar</span>
                        <?php endif; ?>
                      </td>

                      <td>
                        <a href="?p=buku&aksi=deskripsi&id=<?= $pecahBuku['id_buku']; ?>"
                          class="btn btn-primary btn-sm">
                          <i class="fa fa-eye"></i> Lihat Deskripsi
                        </a>
                        <form method="post">
                          <input type="hidden" name="id_buku" value="<?= $pecahBuku['id_buku']; ?>">
                          <button type="submit" class="btn btn-primary" name="tambah">Pinjam</button>
                        </form>

                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
                    }
                    ?>

        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <!-- <div class="text-muted">Copyright &copy; Your Website 2020</div> -->
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