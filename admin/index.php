<?php 
  ob_start();
  session_start();

  include "../config/config.php";
  // require "../config/config.php";

  // Pemeriksaan apakah pengguna sudah login atau belum
if (!isset($_SESSION['user'])) {
  header("location: login.php");
  exit; // Menghentikan eksekusi kode setelah ini
}


  require_once "template/header.php";

?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        <?php 

          if(isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
              case 'home':
                include "dashboard/index.php";
                break;

              case 'data-berita':
                include "berita/data-berita.php";
                break;

              case 'tambah-berita':
                include "berita/tambah-berita.php";
                break;

              case 'edit-berita':
                include "berita/edit-berita.php";
                break;

              case 'hapus-berita':
                include "berita/hapus-berita.php";
                break;

              case 'user':
                include "akun/index.php";
                break;

              case 'tambah-user':
                include "akun/tambah.php";
                break;

              case 'edit-user':
                include "akun/edit.php";
                break;

              case 'hapus-user':
                include "akun/hapus.php";
                break;

              default:
                echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                break;
            }
          } else {
            include "dashboard/index.php";
          }

         ?>

      </div>
      <!-- /. New Row -->
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php 

  require_once "template/footer.php";

?>
