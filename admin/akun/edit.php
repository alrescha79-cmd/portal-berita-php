<?php
include "../config/config.php";

// cek apakah ada parameter id
if (!isset($_GET['id'])) {
  echo "<h3>User not found!</h3>";
  exit;
}

// ambil data dari database berdasarkan id
$id = $_GET['id'];
$sql = mysqli_query($connection, "SELECT * FROM tbl_users WHERE id_user='$id'");
$user = mysqli_fetch_assoc($sql);

// user tidak ditemukan
if (!$user) {
  echo "<h3>User not found!</h3>";
  exit;
}

// Handle Update User
if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $user = $_POST['user'];
  $pass = md5($_POST['pass']);
  $pengguna = $_POST['pengguna'];

  // Set Upload Gambar
  $ekstensi_boleh = array('png', 'jpg', 'jpeg');
  $gambar = $_FILES['file']['name'];
  $ex = explode('.', $gambar);
  $ekstensi = strtolower(end($ex));
  $ukuran = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];

  $sql = mysqli_query($connection, "SELECT * FROM tbl_users WHERE id_user='$id'");
  $data = mysqli_fetch_array($sql);

  // jika gambar diubah
  if (!empty($gambar)) {
    if (in_array($ekstensi, $ekstensi_boleh) === true) {
      if ($ukuran < 2000000) {
        move_uploaded_file($file_tmp, '../assets/img/' . $gambar);
        $sql = mysqli_query($connection, "UPDATE tbl_users SET username='$user', password='$pass', nama_pengguna='$pengguna', img='$gambar' WHERE id_user='$id'");
        // echo "<script>alert('Data Berhasil Diubah!')</script>";
        // echo "<script>window.location.href='index.php?page=user'</script>";
        echo "
        <div class='alert alert-success alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Data berhasil diubah!</strong>
        </div>
        ";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=user'>";
        exit;
      }
    }
  } else {
    // jika password diubah
    if (!empty($pass)) {
      $gambar = $data['img'];
      $sql = mysqli_query($connection, "UPDATE tbl_users SET username='$user', password='$pass' , nama_pengguna='$pengguna', img='$gambar' WHERE id_user='$id'");
      // $sql = mysqli_query($connection, "UPDATE tbl_users SET username='$user', password='" . md5($pass) . "', nama_pengguna='$pengguna', img='$gambar' WHERE id_user='$id'");
      // echo "<script>alert('Data Berhasil Diubah!')</script>";
      // echo "<script>window.location.href='index.php?page=user'</script>";
      echo "
      <div class='alert alert-success alert-dismissible fade show'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Data berhasil diubah!</strong>
      </div>
      ";
      echo "<meta http-equiv='refresh' content='1;url=index.php?page=user'>";
      exit;
    } else {
      // jika password tidak diubah
      // echo "<script>alert('Password Wajib Diisi!')</script>";
      echo "
      <div class='alert alert-danger alert-dismissible fade show'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Password wajib diisi!</strong>
      </div>
      ";
    }
  }
}
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="card card-dark">
            <div class="card-header">
                <h5 class="text-center">Edit User</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="user">Username</label>
                                <input type="text" name="user" id="user" class="form-control"
                                    placeholder="Masukkan Username" value="<?= $user['username'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control"
                                    placeholder="Masukkan Password">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label for="file">Unggah Gambar</label>
                                <input type="file" name="file" id="file" class="form-control"
                                    placeholder="Masukkan File" value="<?= $user['img'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label for="pengguna">Nama Pengguna</label>
                                <input type="pengguna" name="pengguna" id="pengguna" class="form-control"
                                    placeholder="Masukkan Nama Pengguna" value="<?= $user['nama_pengguna'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <button class="btn btn-success btn-block" name="update">Update User</button>
                            <a href="index.php?page=user" class="btn btn-outline-danger btn-block">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
