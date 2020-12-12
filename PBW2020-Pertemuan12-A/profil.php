<?php

// mulai session
session_start();
// panggil fungsi
require "functions.php";
// panggil koneksi db
require "connectDB.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- panggil headtags.html -->
    <?php require "headtags.html"; ?>
    <title>Profil Admin</title>
</head>
<body>

    <!-- navbar -->
    <?php require "navbar.php"; ?>

    <!-- body -->
    <div class="row mt-5" data-aos="fade-down" data-aos-duration="1000">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <?php if (isset($_SESSION["admin"])) : ?>
                    <?php
                        // ambil data admin
                        $admin = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM admin"));
                    ?>
                    <div class="card-header text-center">
                        <h3>Profil Admin</h3>
                    </div>
                    <div class="card-body text-center">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control" value="<?= $admin['username'] ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="simpanData">Simpan Data</button> <a class="btn btn-danger" href="gantiPassword.php">Ganti Password</a>
                            </div>
                        </form>
                    </div>
                <?php elseif (isset($_SESSION["pegawai"])) : ?>
                    <?php
                        // ambil data admin
                        $usernameAsli = $_SESSION["pegawai"];
                        $pegawai = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM pegawai where username = '$usernameAsli'"));
                    ?>
                    <div class="card-header text-center">
                        <h3>Profil Saya</h3>
                    </div>
                    <div class="card-body text-center">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control" value="<?= $pegawai['username'] ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="simpanData">Simpan Data</button> <a class="btn btn-danger" href="gantiPassword.php">Ganti Password</a>
                            </div>
                        </form>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.html" ?>


</body>
</html>

<?php

// jika belum login maka kick ke halaman login
if (!(isset($_SESSION["admin"]) || isset($_SESSION["pegawai"]))){
    echo "
        <script>
            Swal.fire('AKSES DITOLAK','Silahkan Login Terlebih Dahulu','success').then(function(){
                window.location = 'profil.php';
            });
        </script>
    ";
}

// jika dilakukan perubahan
if (isset($_POST["simpanData"])){
    // tangkap value form
    $username = htmlspecialchars($_POST["username"]);

    // validasi
    if (validasiUsername($username) == true){
        if (isset($_SESSION["admin"])){
            mysqli_query($connect,"UPDATE admin SET username = '$username'");
            $_SESSION["admin"] = $username;
        }else if (isset($_SESSION["pegawai"])){
            mysqli_query($connect,"UPDATE pegawai SET username = '$username' where username = '$usernameAsli'");
            $_SESSION["pegawai"] = $username;
        }
        echo "
            <script>
                Swal.fire('Update Profil Berhasil','','success').then(function(){
                    window.location = 'profil.php';
                });
            </script>
        ";
    }

}

?>