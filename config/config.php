<?php


$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "db_berita"; 

$connection = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
