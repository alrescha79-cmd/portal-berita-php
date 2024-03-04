<?php 

	include "../config/config.php";

	// query sesuai session
	$sql = mysqli_query($connection, "SELECT * FROM tbl_users WHERE id_user='$_SESSION[id]'");
	$data = mysqli_fetch_array($sql);

	// query jumlah post
	$sql_post = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE author='$_SESSION[pengguna]'");
	$data_post = mysqli_num_rows($sql_post);

    // Count all users in the database
    $sql_user = mysqli_query($connection, "SELECT COUNT(*) as total FROM tbl_users");
    $data_user = mysqli_fetch_assoc($sql_user);

 ?>
 <!-- Iformasi akun -->
<div class="row">
    <div class="col-lg-4 col-xs-12">
        <div class="card card-dark">
            <div class="card-header">
                <h5 class="text-center">Informasi Akun</h5>
            </div>
            <div class="card-body text-center">
                <img src="../assets/img/<?= $data['img'] ?>" class="img-rounded img-thumbnail">
                <h5 class="mt-3 text-dark text-uppercase"><?= $data['nama_pengguna'] ?></h5>
                <?php 
					if($_SESSION['lvluser'] == 1) { // jika level user adalah 1 (admin)
						echo "<h5 class='text-dark'>Level User : Admin</h5>";								
					} elseif($_SESSION['lvluser'] == 2) { // jika level user adalah 2 (user)
						echo "<h5 class='text-dark'>Level User : User</h5>";
					} 
				?>
            </div>
        </div>
    </div>
    <!-- menamppilkan jumlah  postingan -->
    <div class="col-lg-4">
        <div class="card card-dark">
            <div class="card-header text-center">
                <p><i class="fas fa-user"></i>&nbsp;&nbsp;Jumlah Postingan</p>
            </div>
            <div class="card-body text-center">
                <h3><?= $data_post; ?></h3>
            </div>
        </div>
    </div>
    <?php if($_SESSION['lvluser'] == 1) { ?>
        <div class="col-lg-4">
        <div class="card card-dark">
            <div class="card-header text-center">
                <p><i class="fas fa-user"></i>&nbsp;&nbsp;Jumlah User</p>
            </div>
            <div class="card-body text-center">
                <h3><?= $data_user['total']; ?></h3>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<!-- khusus admin -->
<?php if($_SESSION['lvluser'] == 1) { ?>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="card card-dark">
            <div class="card-header">
                <h5 class="text-center">Data User</h5>
            </div>
            <div class="card-body">
                <a href="index.php?page=tambah-user" class="btn btn-success mb-2"> <i class="fas fa-user-plus"></i>
                    Tambah User</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Profil</th>
                            <th>Username</th>
                            <th>Nama Pengguna</th>
                            <th>Level User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							$no = 1;
							$sql_users = mysqli_query($connection, "SELECT * FROM tbl_users");
							while ($user = mysqli_fetch_assoc($sql_users)) {
								?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="../assets/img/<?= $user['img'] ?>" alt="Foto Profil" width="50" height="50">
                            </td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['nama_pengguna'] ?></td>
                            <td><?= ($user['id_lvuser'] == 1) ? 'Admin' : 'User' ?></td>
                            <td>
                                <a href="index.php?page=edit-user&id=<?= $user['id_user'] ?>"
                                    class="btn btn-sm btn-dark"><i class="fas fa-edit"></i></a>
                                <a href="index.php?page=hapus-user&id=<?= $user['id_user'] ?>"
                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>
