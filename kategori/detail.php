<?php
                include "config/config.php";

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = mysqli_query($connection, "SELECT * FROM tbl_posts WHERE id_post='$id'");
                    $data = mysqli_fetch_assoc($query);

                    if ($data) {
                        echo "<div class='col-lg-10 col-xs-12 mt-3 mx-auto'>";
                        echo "<h3 class='text-primary'>{$data['judul']}</h3>";
                        echo "<p class=''>Penulis: {$data['author']}</p>";
                        echo "<p class='mt-3 text-muted' style='font-size: 12px;'><i class='ion-calendar'></i>&nbsp; {$data['date'] } &nbsp;&nbsp;<a href='#' class='text-muted' style='text-transform: uppercase;text-decoration: none;'>{$data['kategori']}</a></p>";
                        echo "<img src='assets/file/post/{$data['img']}' class='img-fluid'>";
                        
                        // Tampilkan artikel dengan paragraf
                        $paragraphs = explode("\n", $data['artikel']);
                        foreach ($paragraphs as $paragraph) {
                            echo "<p class='mt-5 text-justify'>{$paragraph}</p>";
                        }
                        
                        echo "</div>";
                    } else {
                        echo "<p>Artikel tidak ditemukan.</p>";
                    }
                } else {
                    echo "<p>ID artikel tidak ditemukan.</p>";
                }
                ?>

<!-- rekomendasi berita -->
<section id="sec-rekomendasi" class="mt-5">
        <div class="container mt-5">
            <div class="row mt-5">
                <div class="col-lg-10 col-xs-12 mt-5 mx-auto">
                    <h3 class="text-primary">Rekomendasi Berita</h3>
                    <div class="row mt-5">
                        <?php
                        $query = mysqli_query($connection, "SELECT * FROM tbl_posts ORDER BY id_post DESC LIMIT 3");
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "<div class='col-lg-4 col-xs-12'>";
                            echo "<div class='card'>";
                            echo "<img src='assets/file/post/{$data['img']}' class='card-img-top'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>{$data['judul']}</h5>";
                            echo "<p class='card-text'>{$data['date']}</p>";
                            echo "<a href='?page=detail&id={$data['id_post']}' class='btn btn-primary'>Baca Selengkapnya</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
