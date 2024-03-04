<?php
include "../config/config.php";
// Ambil Kategori dari Database untuk dijadikan option
$sql_kategori = "SHOW COLUMNS FROM `tbl_posts` WHERE Field = 'kategori'";
$result_kategori = mysqli_query($connection, $sql_kategori);
$row_kategori = mysqli_fetch_assoc($result_kategori);
$options = explode(",", str_replace("'", "", substr($row_kategori['Type'], 5, (strlen($row_kategori['Type']) - 6))));// explode untuk memisahkan string menjadi array
?>

<?php
// Tambah Data
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $date = $_POST['tanggal'];
    $artikel = $_POST['artikel'];
    $author = $_SESSION['pengguna'];
    // Set Upload Gambar
    $ekstensi_boleh = array('png', 'jpg', 'jpeg');
    $gambar = $_FILES['file']['name'];
    $ex = explode('.', $gambar);
    $ekstensi = strtolower(end($ex));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Cek Gambar dan Validasi Form
    if (!empty($judul) && !empty($kategori) && !empty($artikel) && in_array($ekstensi, $ekstensi_boleh) && $ukuran < 2000000) {
        move_uploaded_file($file_tmp, '../assets/file/post/' . $gambar);
        // Query untuk menyimpan postingan berita ke database
        $query = mysqli_query($connection, "INSERT INTO tbl_posts (img, judul, artikel, date, kategori, author) VALUES ('$gambar', '$judul', '$artikel', '$date', '$kategori', '$author')");
        if ($query) {
            // echo "<script>alert('Data Berhasil Ditambahkan!')</script>";
            // echo "<script>window.location.href='index.php?page=data-berita'</script>";
            echo "
  <div class='alert alert-success alert-dismissible fade show'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Data berhasil ditambahkan!</strong>
</div>
";
      echo "<meta http-equiv='refresh' content='1;url=index.php?page=data-berita'>";
        } else {
            // echo "<script>alert('Terjadi kesalahan saat menyimpan data.')</script>";
            echo "
  <div class='alert alert-danger alert-dismissible fade show'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Terjadi kesalahan saat menyimpan data!</strong>
</div>
";
        }
    } else {
        // echo "<script>alert('Pastikan semua field diisi dengan benar dan sesuai ketentuan.')</script>";
        echo "
  <div class='alert alert-danger alert-dismissible fade show'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Pastikan semua field diisi dengan benar dan sesuai ketentuan!</strong>
</div>
";
    }
}

?>

<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card card-dark">
            <div class="card-header">
                <h5>Form <?= $_GET['page'] ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="judul" placeholder="Masukkan Judul" class="form-control" required>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <select name="kategori" class="form-control" required>
                                <option value="" disabled>-- Kategori --</option>
                                <!-- kategori mengambil dari database di atas -->
                                <option value="">Pilih Kategori:</option>
                                <?php
                                foreach ($options as $option) {
                                ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <input type="file" name="file" class="form-control" required>
                            <p class="text-danger mt-1" style="font-size: 12px;">Ekstensi File yang di perbolehkan :
                                jpg, png max. 2MB</p>
                            <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <textarea class="form-control" name="artikel" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button name="submit" class="btn btn-success btn-block">Posting Berita</button>
                            <a href="index.php?page=data-berita" class="btn btn-outline-danger btn-block">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


