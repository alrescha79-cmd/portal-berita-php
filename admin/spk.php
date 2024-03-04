<?php 
  ob_start();
  session_start();

  include "./config/config.php";

  // Pemeriksaan apakah pengguna sudah login atau belum
if (!isset($_SESSION['user'])) {
  header("location: admin/login-spk.php");
  exit; // Menghentikan eksekusi kode setelah ini
} 
?>


<div class="row">
  <div class="col-lg-12 col-xs-12">
    <div class="card card-primary">
      <div class="card-header">
        <h5 class="text-center">Beralih Halaman</h5>
      </div>
      <div class="card-body d-flex flex-column text-center gap-2">
        <h4>Apakah Anda yakin untuk beralih ke Halaman SPK | SAW ?</h4>
        <a href="http://localhost/saw/?page=welcome" target="_blank" class="btn btn-danger w-50 mx-auto">Lanjut</a>
        <a href="index.php?page=beranda" class="btn btn-primary w-50 mx-auto">Batal</a>
      </div>
    </div>
  </div> 
</div>
