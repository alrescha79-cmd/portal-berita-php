<?php 

  include "../config/config.php";

   if(isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);

    $sql = mysqli_query($connection, "SELECT * FROM tbl_users WHERE username='$user' AND password='$pass'");

    // Ambil Data Lv User
      $data = mysqli_fetch_array($sql);

      // Ambil Data True or False
      $cek = mysqli_num_rows($sql);

      if ($cek > 0) {
        session_start();

      // Passing Data
      $_SESSION['id'] = $data['id_user'];
      $_SESSION['user'] = $data['username'];
      $_SESSION['pengguna'] = $data['nama_pengguna'];
      $_SESSION['lvluser'] = $data['id_lvuser'];
      
      echo "
      <div class='alert alert-success alert-dismissible fade show'>
      <strong class='text-center'>Login Berhasil!</strong>
      <p>Selamat Datang $_SESSION[pengguna]</p>
    </div>
    ";
    echo "
    <div class='spinner-border text-primary mb-3 ' style='width: 50px; height: 50px' role='status'>
    <span class='sr-only'>Loading...</span>
  </div>
    ";
    echo "<meta http-equiv='refresh' content='1.5; url=http://localhost/saw/?page=welcome' target='_blank'>";
    } else {
      echo "
  <div class='alert alert-danger alert-dismissible fade show'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Username atau Password salah!</strong>
</div>
";
    }
  }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn Admin - SPK | SAW</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/login/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/css/login/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/login/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/login/animasi.css">
</head>

<body class="hold-transition login-page bg-dark-subtle overflow-hidden">
    <div class="login-box overflow-hidden">
        <!-- /.login-logo -->
        <div class="card card-outline card-dark" style="z-index: 99;">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>SPK | SAW</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login untuk mengakses Menu :)</p>

                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="user" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="pass" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-dark btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->


    <!-- jQuery -->
    <script src="../assets/js/login/jquery/jquery.min.js"></script>
    <!-- Bootstrap  -->
    <script src="../assets/js/login/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/js/login/adminlte.min.js"></script>
</body>

</html>
