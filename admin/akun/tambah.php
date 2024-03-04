<?php
include "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = $_POST['user'];
  $pass = md5($_POST['pass']);
  $pengguna = $_POST['pengguna'];
  $lvluser = $_POST['lvluser'];

  // Set Upload Gambar
  $ekstensi_boleh = array('png', 'jpeg', 'jpg'); // ekstensi file yang boleh diupload
  $gambar = $_FILES['file']['name']; // ambil nama file
  $ex = explode('.', $gambar); // explode nama file
  $ekstensi = strtolower(end($ex)); // ambil ekstensi file menjadi huruf kecil semua
  $ukuran = $_FILES['file']['size']; // ambil ukuran file
  $file_tmp = $_FILES['file']['tmp_name'];  // ambil lokasi file sementara

//   jika gambar diupload
  if (in_array($ekstensi, $ekstensi_boleh) === true) {
    // jika ukuran file kurang dari 2MB
    if ($ukuran < 2000000) {
      move_uploaded_file($file_tmp, '../assets/img/' . $gambar);
      $sql = mysqli_query($connection, "INSERT INTO tbl_users VALUES (NULL, '$user', '$pass', '$pengguna', '$gambar', '$lvluser')");

      if ($sql) {
        // echo "<script>alert('Data Berhasil Ditambahkan!')</script>";
        // echo "<script>window.location.href='index.php?page=user'</script>";
        echo "
        <div class='alert alert-success alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Data berhasil ditambahkan!</strong>
        </div>
        ";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=user'>";
      } else { // jika gagal menambahkan data
        // echo "<script>alert('Gagal menambahkan data. Silakan coba lagi!')</script>";
        echo "
        <div class='alert alert-danger alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Gagal menambahkan data. Silakan coba lagi!</strong>
        </div>
        ";
      }
    } else { // jika ukuran file lebih dari 2MB
    //   echo "<script>alert('Ukuran tidak boleh > 2MB')</script>";
        echo "
        <div class='alert alert-danger alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Ukuran tidak boleh lebih dari 2MB!</strong>
        </div>
        ";
    }
  } else { // jika ekstensi file tidak sesuai
    // echo "<script>alert('Ekstensi tidak sesuai')</script>";
    echo "
    <div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Ekstensi tidak sesuai!</strong>
    </div>
    ";
  }
}
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="card card-dark">
            <div class="card-header">
                <h5 class="text-center">Form Tambah Akun</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="user">Username</label>
                                <input type="text" name="user" id="user" class="form-control"
                                    placeholder="Masukkan Username">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control"
                                    placeholder="Masukkan Password">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="file">Unggah Gambar</label>
                                <input type="file" name="file" id="file" class="form-control"
                                    placeholder="Masukkan File">
                                <small class="text-danger">*File berekstensi png, jpeg, dan jpg</small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="lvluser">Level User</label>
                                <select name="lvluser" id="lvluser" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label for="pengguna">Nama Pengguna</label>
                                <input type="text" name="pengguna" id="pengguna" class="form-control"
                                    placeholder="Masukkan Nama Pengguna">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <button class="btn btn-success btn-block" name="tambah">Simpan</button>
                            <a href="index.php?page=user" class="btn btn-outline-danger btn-block">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
