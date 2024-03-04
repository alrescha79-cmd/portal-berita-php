<?php

include "config/config.php";

$query = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE kategori='politik' ORDER BY date DESC");

$news = mysqli_query($connection, "SELECT * FROM tbl_posts ORDER BY date DESC LIMIT 5");

?>

<h1>Berita Politik</h1>
<?php while ($data = mysqli_fetch_assoc($query)) : ?>
<div class="col-md-4 col-xs-12 my-3">
    <a href="?page=detail&id=<?= $data['id_post'] ?>" style="text-decoration: none;">
        <h4 class="text-primary mb-2 d-block overflow-hidden" style="height: 86px;"><?= $data['judul'] ?></h4>
        <img src="assets/file/post/<?= $data['img'] ?>" alt="" class="img-thumbnail d-block">
        <div class="d-block text-dark">
            <i class="ion-calendar">&nbsp; <?= $data['date'] ?> &nbsp; / &nbsp;</i>
            <i class="ion-person">&nbsp; <?= $data['author'] ?></i>
        </div>
        <hr class="text-dark">
        <p class="article-text d-block text-dark">
            <?= substr($data['artikel'], 0, 100) ?>
        </p>
        <a href="?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
    </a>
</div>
<?php endwhile; ?>
<hr>
<br><br>

<!-- Berita terbaru -->
<h1 class="text-primary">Berita Terbaru</h1>
<div class="col-12 ">
    <ol class=" px-4 ml-4">
        <?php
  while ($data = mysqli_fetch_assoc($news)) :
  ?>
        <li class="fw-semibold">
            <a class="d-block text-dark" style="text-decoration: none; font-size: 18px;"
                href="?page=detail&id=<?= $data['id_post'] ?>"><?= $data['judul'] ?></a>
        </li>
        <?php
    endwhile;
  ?>
    </ol>
</div>
