<?php 

include "../config/config.php";

if ($_SESSION['lvluser'] == 1) {
    // Count all posts in the database
    $sql_all_posts = mysqli_query($connection, "SELECT COUNT(*) as total FROM tbl_posts");
    $data_all_posts = mysqli_fetch_assoc($sql_all_posts);

    // Count all users in the database
    $sql_user = mysqli_query($connection, "SELECT COUNT(*) as total FROM tbl_users");
    $data_user = mysqli_fetch_assoc($sql_user);

    // Count posts in each category
    $sql_category_posts = mysqli_query($connection, "SELECT kategori, COUNT(*) as total FROM tbl_posts GROUP BY kategori");
    $category_posts = array();
    while ($row = mysqli_fetch_assoc($sql_category_posts)) {
        $category_posts[$row['kategori']] = $row['total'];
    }

    // query jumlah post
	$sql_post = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE author='$_SESSION[pengguna]'");
	$data_post = mysqli_num_rows($sql_post);

} else {
    // Count only the user's posts
    $sql_user_posts = mysqli_query($connection, "SELECT COUNT(*) as total FROM tbl_posts WHERE author='$_SESSION[pengguna]'");
    $data_user_posts = mysqli_fetch_assoc($sql_user_posts);
}

?>

<?php if ($_SESSION['lvluser'] == 1) { ?>
    <div class="row mb-5">
    <div class="col-lg-12">
        <div class="card card-dark">
            <div class="card-header text-center">
                <h5>Selamat Datang <b class="text-primary bg-white rounded rounded-2 px-1">
                        <?= $_SESSION['pengguna']; ?></b></h5>
            </div>
            <div class="card-body">
                <p>
                    Selamat datang di halaman dashboard, <b> <?= $_SESSION['user']; ?> </b>. Silahkan kelola berita yang
                    ada di website ini.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-lg-4">
        <div class="card card-dark">
            <div class="card-header text-center">
                <p><i class="fas fa-newspaper"></i>&nbsp;&nbsp;Jumlah Semua Postingan</p>
            </div>
            <div class="card-body text-center">
                <h3><?= $data_all_posts['total']; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-dark">
            <div class="card-header text-center">
                <p><i class="fas fa-podcast"></i>&nbsp;&nbsp;Jumlah Postingan Saya</p>
            </div>
            <div class="card-body text-center">
                <h3><?= $data_post; ?></h3>
            </div>
        </div>
    </div>
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
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-dark">
            <div class="card-header text-center">
                <h5>Kategori Postingan</h5>
            </div>
            <div class="card-body">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- script -->
<script src="../assets/js/be/chart.js/Chart.min.js"></script>
<script>
    const data = {
        labels: <?= json_encode(array_keys($category_posts)); ?>,
        datasets: [{
            label: 'Jumlah Postingan',
            data:  <?= json_encode(array_values($category_posts)); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)',
                'rgb(54, 162, 235)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const myChart = new Chart(
        document.getElementById('chart'),
        config
    );
</script>


<!-- level user 2 -->
<?php } else { ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-dark">
            <div class="card-header text-center">
                <h5>Selamat Datang <b class="text-primary bg-white rounded rounded-2 px-1">
                        <?= $_SESSION['pengguna']; ?></b></h5>
            </div>
            <div class="card-body">
                <p>
                    Selamat datang di halaman dashboard, <b> <?= $_SESSION['user']; ?> </b>. Silahkan kelola berita yang
                    ada di website ini. Jika ada pertanyaan, silahkan hubungi admin. Terima kasih.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-dark">
                    <div class="card-header text-center">
                        <p><i class="fas fa-newspaper"></i>&nbsp;&nbsp;Jumlah Postingan Kamu</p>
                    </div>
                    <div class="card-body text-center">
                        <h3><?= $data_user_posts['total']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
