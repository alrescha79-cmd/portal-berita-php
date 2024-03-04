<nav class="navbar navbar-expand-lg navbar-light sticky-top p-2" id="navbar"
    style="backdrop-filter: blur(10px); background: rgba(0, 0, 0, 0.3);">
    <div class="container-fluid">
        <h1 class="navbar-brand text-primary mb-2">beri<b class="text-primary"
                style="font-weight: 900; font-size: 24px;">.</b><b class="text-danger fw-bolder">TA</b></h1>
        <ul class="nav nav-tabs mx-auto my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link<?= ($_GET['page'] === 'beranda') ? ' active' : '' ?>"
                    href="index.php?page=beranda">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($_GET['page'] === 'politik') ? ' active' : '' ?>"
                    href="index.php?page=politik">Politik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($_GET['page'] === 'olahraga') ? ' active' : '' ?>"
                    href="index.php?page=olahraga">Olahraga</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($_GET['page'] === 'selebritis') ? ' active' : '' ?>"
                    href="index.php?page=selebritis">Selebritis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($_GET['page'] === 'teknologi') ? ' active' : '' ?>"
                    href="index.php?page=teknologi">Teknologi</a>
            </li>
        </ul>
        <div class="d-flex">
            <a href="http://localhost/berita/admin/login.php" class="btn btn-outline-primary me-2">Log In</a>
            <a href="index.php?page=spk" class="btn btn-primary">SPK</a>
        </div>
    </div>
</nav>
