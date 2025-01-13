<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'perpustakaan';

$conn = new mysqli($host, $username, $password, $dbname);

if (!$conn) {
  die("Koneksi tidak tersedia");
} else {
  echo "Koneksi berhasil!";
}