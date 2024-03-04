<?php
include "config/config.php";

// Query to get the latest 5 posts for the carousel
$query_carousel = mysqli_query($connection, "SELECT * FROM tbl_posts ORDER BY date DESC LIMIT 5");

$politik = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE kategori='politik' ORDER BY date DESC");
$olahraga = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE kategori='olahraga' ORDER BY date DESC");
$seleb = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE kategori='selebritis' ORDER BY date DESC");
$teknologi = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE kategori='teknologi' ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    .carousel-inner img {
        max-height: 300px;
        object-fit: cover;
    }

    .judul {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        color: white;
        text-shadow: 2px 2px 2px black;
    }

    .kartu {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tubuh-kartu {
        display: flex;
        align-items: center;
    }

    .tubuh-kartu img {
        flex-shrink: 0;
        margin-right: 20px;
    }

    .link-post {
        color: black;
        text-decoration: none;
    }
    </style>
</head>

<body>

    <!-- Headline Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <?php
        $indicator_active = 'class="active"';
        for ($i = 0; $i < mysqli_num_rows($query_carousel); $i++) {
            echo '<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" ' . $indicator_active . '></li>';
            $indicator_active = '';
        }
        ?>
        </ol>
        <div class="carousel-inner">
            <?php
        $active_item = 'active';
        while ($data_carousel = mysqli_fetch_assoc($query_carousel)) :
        ?>
            <div class="carousel-item <?= $active_item; ?>">
                <a href="?page=detail&id=<?= $data_carousel['id_post']; ?>">
                    <img src="assets/file/post/<?= $data_carousel['img']; ?>" class="d-block w-100"
                        alt="<?= $data_carousel['judul']; ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class=" judul"><?= $data_carousel['judul']; ?></h5>
                    </div>
                </a>
            </div>
            <?php
            $active_item = '';
        endwhile;
        ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon  shadow-lg" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon  shadow-lg" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <!-- akhir carousel -->
    <hr>
    <br>

    <h1 class="mt-4">Berita Terbaru</h1>

    <?php
// Reset the data pointer for the main loop
mysqli_data_seek($query_carousel, 0);
?>
    <div class="row">
        <?php while ($data = mysqli_fetch_assoc($query_carousel)) : ?>
        <div class="col-12 my-3">
            <div class="card kartu">
                <div class="card-body tubuh-kartu d-flex gap-2">
                    <a class="link-post" href="?page=detail&id=<?= $data['id_post'] ?>">
                        <img src="assets/file/post/<?= $data['img'] ?>" alt="" class="img-thumbnail mr-5 d-block"
                            style="max-width: 400px;">
                        <div>
                            <div class="d-block">
                                <i class="ion-calendar">&nbsp; <?= $data['date'] ?> &nbsp; / &nbsp;</i>
                                <i class="ion-person">&nbsp; <?= $data['author'] ?></i>
                            </div>
                            <h3 class="text-primary mb-2 d-block"><?= $data['judul'] ?></h3>
                            <h6 class="article-text d-block">
                                <?= substr($data['artikel'], 0, 200)."..." ?>
                            </h6>
                            <a href="?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary">Baca
                                Selengkapnya</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <hr>

    <br><br><br><br>

    <!-- politik -->
    <h1>Berita Politik</h1>
    <?php while ($data = mysqli_fetch_assoc($politik)) : ?>
        <div class="col-md-4 col-xs-12 my-3">
        <a href="?page=detail&id=<?= $data['id_post'] ?>" style="text-decoration: none;">
        <h4 class="text-primary mb-2 d-block overflow-hidden" style="height: 86px;"><?= $data['judul'] ?></h4>
            <img src="assets/file/post/<?= $data['img'] ?>" alt="" class="img-thumbnail d-block">
            <div class="d-block text-dark">
                <i class="ion-calendar">&nbsp; <?= $data['date'] ?> &nbsp; / &nbsp;</i>
                <i class="ion-person">&nbsp; <?= $data['author'] ?></i>
            </div><hr class="text-dark">
            <p class="article-text d-block text-dark">
                <?= substr($data['artikel'], 0, 100) ?>
            </p>
            <a href="?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
        </a>
    </div>
    <?php endwhile; ?>
    <hr>

    <br><br><br>

    <!-- olahraga -->
    <h1>Berita Olahraga</h1>
    <?php while ($data = mysqli_fetch_assoc($olahraga)) : ?>
        <div class="col-md-4 col-xs-12 my-3">
        <a href="?page=detail&id=<?= $data['id_post'] ?>" style="text-decoration: none;">
        <h4 class="text-primary mb-2 d-block overflow-hidden" style="height: 86px;"><?= $data['judul'] ?></h4>
            <img src="assets/file/post/<?= $data['img'] ?>" alt="" class="img-thumbnail d-block">
            <div class="d-block text-dark">
                <i class="ion-calendar">&nbsp; <?= $data['date'] ?> &nbsp; / &nbsp;</i>
                <i class="ion-person">&nbsp; <?= $data['author'] ?></i>
            </div><hr class="text-dark">
            <p class="article-text d-block text-dark">
                <?= substr($data['artikel'], 0, 100) ?>
            </p>
            <a href="?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
        </a>
    </div>
    <?php endwhile; ?>
    <hr>
    <br><br><br>
    <!-- selebritis -->
    <h1>Berita Selebritis</h1>
    <?php while ($data = mysqli_fetch_assoc($seleb)) : ?>
        <div class="col-md-4 col-xs-12 my-3">
        <a href="?page=detail&id=<?= $data['id_post'] ?>" style="text-decoration: none;">
        <h4 class="text-primary mb-2 d-block overflow-hidden" style="height: 86px;"><?= $data['judul'] ?></h4>
            <img src="assets/file/post/<?= $data['img'] ?>" alt="" class="img-thumbnail d-block">
            <div class="d-block text-dark">
                <i class="ion-calendar">&nbsp; <?= $data['date'] ?> &nbsp; / &nbsp;</i>
                <i class="ion-person">&nbsp; <?= $data['author'] ?></i>
            </div><hr class="text-dark">
            <p class="article-text d-block text-dark">
                <?= substr($data['artikel'], 0, 100) ?>
            </p>
            <a href="?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
        </a>
    </div>
    <?php endwhile; ?>
    <hr>
    <br><br><br>
    <!-- teknologi -->
    <h1>Berita Teknologi</h1>
    <?php while ($data = mysqli_fetch_assoc($teknologi)) : ?>
        <div class="col-md-4 col-xs-12 my-3">
        <a href="?page=detail&id=<?= $data['id_post'] ?>" style="text-decoration: none;">
        <h4 class="text-primary mb-2 d-block overflow-hidden" style="height: 86px;"><?= $data['judul'] ?></h4>
            <img src="assets/file/post/<?= $data['img'] ?>" alt="" class="img-thumbnail d-block">
            <div class="d-block text-dark">
                <i class="ion-calendar">&nbsp; <?= $data['date'] ?> &nbsp; / &nbsp;</i>
                <i class="ion-person">&nbsp; <?= $data['author'] ?></i>
            </div><hr class="text-dark">
            <p class="article-text d-block text-dark">
                <?= substr($data['artikel'], 0, 100) ?>
            </p>
            <a href="?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
        </a>
    </div>
    <?php endwhile; ?>

</body>

</html>
