<?php
include "../config/config.php";

// cek apakah ada parameter id
if (!isset($_GET['id'])) {
  echo "<h3>User not found!</h3>";
  exit;
}

$id = $_GET['id'];
$sql = mysqli_query($connection, "SELECT * FROM tbl_users WHERE id_user='$id'");
$user = mysqli_fetch_assoc($sql);

// jika user tidak ditemukan
if (!$user) {
  echo "<h3>User not found!</h3>";
  exit;
}

// Handle Delete User
if (isset($_POST['delete'])) {
  $id = $_GET['id'];
  $sql = mysqli_query($connection, "DELETE FROM tbl_users WHERE id_user='$id'");
  // echo "<script>alert('Data Berhasil Dihapus!')</script>";
  // echo "<script>window.location.href='index.php?page=user'</script>";
  echo "
  <div class='alert alert-success alert-dismissible fade show'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Data berhasil dihapus!</strong>
</div>
";
      echo "<meta http-equiv='refresh' content='1;url=index.php?page=user'>";
  exit;
}
?>

<!-- alert untuk hapus -->
<div class="row">
  <div class="col-lg-12 col-xs-12">
    <div class="card card-dark">
      <div class="card-header">
        <h5 class="text-center">Hapus User</h5>
      </div>
      <div class="card-body">
        <h4 class="text-center">Anda yakin ingin menghapus pengguna <span class="bg-primary px-2 rounded">
            <?= $user['username'] ?></span> ?</h4>
        <form method="POST" class="d-flex flex-column">
          <a href="index.php?page=user" class="btn btn-primary w-50 mx-auto my-1">Batal</a>
          <button class="btn btn-outline-danger w-50 mx-auto my-1" name="delete">Hapus User</button>
        </form>
      </div>
    </div>
  </div>
</div>
