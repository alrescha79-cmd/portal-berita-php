<?php

$id = $_GET['id'];

// cek apakah ID kosong atau tidak
$sql_check_record = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE id_post='$id'");
if (mysqli_num_rows($sql_check_record) === 0) {
    // jika tidak ada record, tampilkan pesan kesalahan
    echo "<script>alert('Data Berita tidak ditemukan!')</script>";
    echo "<script>window.location.href='index.php?page=data-berita'</script>";
    exit;
}

$sql = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE id_post='$id'");
$data = mysqli_fetch_array($sql);

// Ambil Kategori dari Database untuk dijadikan option
$sql_kategori = "SHOW COLUMNS FROM `tbl_posts` WHERE Field = 'kategori'";
$result_kategori = mysqli_query($connection, $sql_kategori);
$row_kategori = mysqli_fetch_assoc($result_kategori);
$options = explode(",", str_replace("'", "", substr($row_kategori['Type'], 5, (strlen($row_kategori['Type']) - 6)))); // explode untuk memisahkan string menjadi array
?>

<?php 
// cek apakah tombol submit sudah di klik atau belum
$successMessage = '';
	if(isset($_POST['submit'])) {
		$id = $_GET['id'];
		$judul = $_POST['judul'];
		$kategori = $_POST['kategori'];
		$date = $_POST['tanggal'];
		$artikel = $_POST['artikel'];
		$author = $_SESSION['pengguna'];
		// Set Upload Gambar
		$ekstensi_boleh = array('png', 'jpg');
		$gambar = $_FILES['file']['name'];
		$ex = explode('.', $gambar);
		$ekstensi = strtolower(end($ex));
		$ukuran = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];

		$sql= mysqli_query($connection, "SELECT * FROM tbl_posts WHERE id_post='$id'");
		$data = mysqli_fetch_array($sql);

            // cek apakah gambar di ubah atau tidak
			if(!empty($gambar)) {
                // cek apakah ekstensi file sesuai atau tidak
				if(in_array($ekstensi, $ekstensi_boleh) === true) {
					if($ukuran < 2000000) {
						move_uploaded_file($file_tmp, '../assets/file/post/'. $gambar);
						$sql = mysqli_query($connection, "UPDATE tbl_posts SET img='$gambar', judul='$judul', artikel='$artikel', kategori='$kategori' WHERE id_post='$id'");
						// echo "<script>alert('Data Berhasil Di ubah!')</script>";
						// echo "<script>window.location.href='index.php?page=data-berita'</script>";
                        $successMessage = "
    <div class='alert alert-success alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Data berhasil diubah!</strong>
    </div>
    ";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=data-berita'>";
					}
				} 
			} else {
                // jika gambar tidak di ubah
				$gambar = $data['img'];
				$sql = mysqli_query($connection, "UPDATE tbl_posts SET img='$gambar', judul='$judul', artikel='$artikel', kategori='$kategori' WHERE id_post='$id'");
				// echo "<script>alert('Data Berhasil Di ubah!')</script>";
				// echo "<script>window.location.href='index.php?page=data-berita'</script>";
                $successMessage = "
    <div class='alert alert-success alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Data berhasil diubah!</strong>
    </div>
    ";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=data-berita'>";
			}
	}

 ?>

<?php echo $successMessage; ?>


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
                            <label for="judul">Judul Artikel</label>
                            <input type="text" name="judul" placeholder="Masukkan Judul" class="form-control"
                                value="<?= $data['judul'] ?>">
                        </div>

                        <div class="col-lg-6 mt-3">
                            <label for="kategori">Pilih Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="" disabled>-- Kategori --</option>
                                <?php
        foreach ($options as $option) {
            $selected = ($data['kategori'] === $option) ? 'selected' : '';
            ?>
                                <option value="<?= $option; ?>" <?= $selected; ?>><?= $option; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-6 mt-3">
                            <label for="file">Masukkan File Gambar</label>
                            <input type="file" name="file" class="form-control">
                            <input type="hidden" name="tanggal" value="<?= date("Y-m-d"); ?>">
                            <!-- menampilkan gambar  -->
                            <?php if (!empty($data['img'])) { ?>
                            <img src="../assets/file/post/<?= $data['img']; ?>" alt="Current Image"
                                style="max-width: 100px;">
                            <?php } ?>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label for="text">Masukkan Deskripsi Artikel</label>
                            <textarea class="form-control" name="artikel" cols="30"
                                rows="10"><?= $data['artikel'] ?></textarea>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button name="submit" class="btn btn-primary btn-block">Edit Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
