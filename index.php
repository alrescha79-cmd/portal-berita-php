<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>beriTA | <?= $_GET['page'] ?></title>

    <link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">

	<style>
  .nav-tabs .nav-link.active {
    color: white; 
    background-color: rgba(0, 0, 0, 0.1);
    border: 1px solid white; 
    border-radius: 0.25rem; 
  }
</style>
</head>

<body>
    <?php 
		require_once "template/navbar.php";
	 ?>



    <section id="sec-article" class="mt-1">

        <div class="container">
            <div class="row my-5">
                <?php 
				// pilih menu
				if (isset($_GET['page'])) {
					$page = $_GET['page'];

					switch ($page) {
						case 'beranda':
							include "kategori/beranda.php";
							break;
				
						case 'politik':
							include "kategori/politik.php";
							break;
				
						case 'olahraga':
							include "kategori/olahraga.php";
							break;
				
						case 'selebritis':
							include "kategori/selebritis.php";
							break;
				
						case 'teknologi':
							include "kategori/teknologi.php";
							break;

						case 'detail':
							include "kategori/detail.php";
							break;

						case 'spk':
							include "./admin/spk.php";
							break;

							default:
							echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
							break;
						
					}
					
				} else {
					header("location: index.php?page=beranda");
					include "kategori/beranda.php";
				}

			 ?>

            </div>
        </div>
    </section>

    <?php 
		require_once "template/footer.php";
		 ?>

    <script src="assets/js/bootstrap.js"></script>

</body>

</html>
