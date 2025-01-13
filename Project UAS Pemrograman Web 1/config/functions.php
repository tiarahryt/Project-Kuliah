<?php 
require_once 'koneksi.php';

function register($data) {
	global $conn;
	$nama = htmlspecialchars($data['nama']);
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$password2 = $conn->real_escape_string($_POST['password2']);

	$cekUsername = $conn->query("SELECT * FROM tb_user WHERE username = '$username'") or die(mysqli_error($conn));
	if($cekUsername->num_rows > 0) {
		echo "<script>alert('Username sudah terdaftar!');window.location='register.php';</script>";
		return false;
	}

	if($password != $password2) {
		echo "<script>alert('konfirmasi password salah.');</script>";
		return false;
	}

	if(strlen($username) < 3 ) {
		echo "<script>alert('Password terlalu pendek, maksimal 6 digit');window.location='register.php';</script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	$level = 'peminjam';

	$conn->query("INSERT INTO tb_user VALUES (null, '$username', '$password', '$nama', '$level')") or die(mysqli_error($conn));
	return $conn->affected_rows;
}