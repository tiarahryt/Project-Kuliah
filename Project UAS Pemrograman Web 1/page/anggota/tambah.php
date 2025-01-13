<?php 
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $level = 'petugas'; 

    if (empty($username) || empty($password) || empty($nama)) {
        echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=register';</script>";
    } else {
       
        $checkUser = $conn->query("SELECT * FROM tb_user WHERE username = '$username'");
        if ($checkUser->num_rows > 0) {
            echo "<script>alert('Username sudah digunakan, silakan pilih username lain.');window.location='?p=register';</script>";
        } else {
            $sql = $conn->query("INSERT INTO tb_user (nama, username, password, level) VALUES ('$nama', '$username', '$password', '$level')") or die(mysqli_error($conn));
            if ($sql) {
                echo "<script>alert('Registrasi Berhasil.');window.location='?p=anggota';</script>";
            } else {
                echo "<script>alert('Registrasi Gagal.');</script>";
            }
        }
    }
}
?>

<h1 class="mt-4">Registrasi Petugas</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
  <li class="breadcrumb-item active">Registrasi Petugas</li>
</ol>
<div class="card-header mb-5">

  <form action="" method="post">
    <div class="form-group">
      <label class="small mb-1" for="nama">Nama Lengkap</label>
      <input class="form-control" id="nama" name="nama" type="text" placeholder="Masukan nama lengkap" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="username">Username</label>
      <input class="form-control" id="username" name="username" type="text" placeholder="Masukan username" />
    </div>
    <div class="form-group">
      <label class="small mb-1" for="password">Password</label>
      <input class="form-control" id="password" name="password" type="password" placeholder="Masukan password" />
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="tambah">Registrasi</button>
    </div>
  </form>
</div>