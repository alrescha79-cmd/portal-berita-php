<?php 

	// Jika level user adalah 1 (admin)
	if ($_SESSION['lvluser'] == 1) {
		$sql = mysqli_query($connection, "SELECT * FROM tbl_posts ORDER BY date DESC");
	} else { // Jika level user adalah 2 (user)
		$sql = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE author='$_SESSION[pengguna]' ORDER BY date DESC");
	}

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-dark">
            <div class="card-header">
                <h5>Data Postingan Berita</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Artikel</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $no = 1; foreach($sql as $data): ?>
                    <tr>
                        <td class=""><?= $no++; ?></td>
                        <td><?= substr($data['judul'], 0, 50)."..."?></td>
                        <td><?= substr($data['artikel'], 0, 100)."..." ?></td>
                        <td class="text-center">
                            <img src="../assets/file/post/<?= $data['img'] ?>" width="80" height="50">
                        </td>
                        <td><?= $data['date'] ?></td>
                        <td><?= $data['kategori'] ?></td>
                        <td><?= $data['author'] ?></td>
                        <td class="text-center">
                            <a  href="index.php?page=hapus-berita&id=<?=$data['id_post'] ?>" class="btn btn-danger m-2">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="index.php?page=edit-berita&id=<?=$data['id_post'] ?>"
                                class="btn btn-dark text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
