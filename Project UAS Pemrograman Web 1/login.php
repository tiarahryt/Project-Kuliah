<?php 
session_start();
require_once 'config/koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM tb_user WHERE username = '$username'") or die(mysqli_error($conn));
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level'];

            if (!isset($_SESSION['id_user'])) {
                echo "<script>alert('Anda harus login terlebih dahulu.'); window.location='login.php';</script>";
                exit;
            }
  
            if ($row['level'] === 'admin') {
                header("Location: index.php");
            } elseif ($row['level'] === 'peminjam') {
                header("Location: halaman_peminjam.php");
            } elseif ($row['level'] === 'petugas') {
                header("Location: halaman_petugas.php");
            }
            exit;
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Halaman Login</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
  </script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="form-group">
                      <label class="small mb-1" for="username">Username</label>
                      <input class="form-control py-4" name="username" id="username" type="text"
                        placeholder="Masukan username anda" required />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1" for="password">Password</label>
                      <input class="form-control py-4" id="password" name="password" type="password"
                        placeholder="Masukan password" required />
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center">
                  <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="js/scripts.js"></script>
</body>

</html>