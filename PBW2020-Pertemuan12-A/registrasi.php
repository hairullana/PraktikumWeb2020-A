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
    <!-- judul -->
    <title>Registrasi Pegawai</title>
    <!-- panggil headtags -->
    <?php require "headtags.html"; ?>

</head>
<body>

    <!-- navbar -->
    <?php require "navbar.php"; ?>

    <!-- body -->
    <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Registrasi Pegawai</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password1" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password2" placeholder="Ulang Password" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="daftar" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end body -->

    <!-- footer -->
    <?php require "footer.html"; ?>

</body>
</html>

<?php

// jika sudah login, maka tendang ke index
if (isset($_SESSION["admin"]) || isset($_SESSION["pegawai"])) {
    echo "
        <script>
            Swal.fire('AKSES DITOLAK','Sadar, Anda Sudah Login Bro !','warning').then(function(){
                window.location = 'index.php';
            });
        </script>
    ";
}

// jika sudah mengklik tombol sign up
if (isset($_POST["daftar"])){

    // tangkap semua value form
    $username = htmlspecialchars($_POST["username"]);
    $password1 = htmlspecialchars($_POST["password1"]);
    $password2 = htmlspecialchars($_POST["password2"]);

    // cek apakah username sudah terdaftar
    $cek = mysqli_query($connect, "SELECT * from pegawai where username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "
            <script>
                Swal.fire('REGISTRASI GAGAL','Username Sudah Terdaftar Gan','warning').then(function(){
                    window.location = 'registrasi.php';
                });
            </script>
        ";
    }else {

        // validasi
        if (validasiUsername($username) == true){
            if (validasiPassword($password1) == true) {
                if (validasiPassword($password2) == true){
                    // jika password tidak sama
                    if ($password1 != $password2) {
                        echo "
                            <script>
                                Swal.fire('FORM ERROR','Password Tidak Sama !','warning').then(function(){
                                    window.location = 'registrasi.php';
                                });
                            </script>
                        ";
                    }else {     // jika berhasil melewati semua validasi
                        // hash password
                        $password = password_hash($password1, PASSWORD_DEFAULT);
                        // masukkan data ke tabel pegawai
                        mysqli_query($connect, "INSERT into pegawai values('','$username','$password')");
                        // buat session pegawai
                        $_SESSION["pegawai"] = $username;
                        // buat alert
                        echo "
                            <script>
                                Swal.fire('REGISTRASI BERHASIL','','success').then(function(){
                                    window.location = 'index.php';
                                });
                            </script>
                        ";
                    }
                }
            }
        }
    }


}

?>