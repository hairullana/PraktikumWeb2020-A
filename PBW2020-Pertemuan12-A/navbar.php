<?php?>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Brand Name -->
        <a class="navbar-brand" data-aos="fade-right" data-aos-duration="1000" href="index.php"><i class="fa fa-home"></i> Data Mahasiswa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Link Navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav" data-aos="fade-left" data-aos-duration="1000">
                <?php if (isset($_SESSION["admin"])) : ?>
                    <!-- jika login admin -->
                    <li class="nav-item active">
                        <a class="nav-link" href="profil.php"><i class="fa fa-user"></i> <?= $_SESSION["admin"] . " [admin]"; ?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                <?php elseif (isset($_SESSION["pegawai"])) : ?>
                    <!-- jika sudah login pegawai -->
                    <li class="nav-item active">
                        <a class="nav-link" href="profil.php"><i class="fa fa-user"></i> <?= $_SESSION["pegawai"] . " [pegawai]"; ?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                <?php else : ?>
                    <!-- jika belum login -->
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- end navbar -->