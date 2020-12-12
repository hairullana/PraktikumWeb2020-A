<?php

// mulai session
session_start();
// paangil functions.php
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
    <title>Login</title>
    <!-- panggil headtags.html -->
    <?php require "headtags.html"; ?>
</head>
<body>

    <!-- body -->
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <div class="card" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-center">
                    <h3>Halaman Login</h3>
                </div>
                <div class="card-body">
                    <!-- form -->
                    <form action="" method="POST">
                        <div class="form-group text-center">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="user" id="exampleRadios1" value="admin">
                            <label class="form-check-label" for="exampleRadios1">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="user" id="exampleRadios2" value="pegawai">
                            <label class="form-check-label" for="exampleRadios2">Pegawai</label>
                        </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="login" class="btn btn-primary">Sign In</button> <a href="registrasi.php" class="btn btn-success text-white">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- inisialisasi aos -->
    <script>
        AOS.init();
    </script>

</body>
</html>

<?php

// jika sudah login, maka tendang ke index.php
if (isset($_SESSION["admin"]) || isset($_SESSION["pegawai"])){
    echo "
        <script>
            Swal.fire('ANDA SUDAH LOGIN', '','error').then(function(){
                window.location = 'index.php';
            });
        </script>
    ";
}

// jika user melakukan login
if (isset($_POST["login"])){

    // jika belum memilih jenis user
    if (!isset($_POST["user"])){
        echo "
            <script>
                Swal.fire('GAGAL LOGIN','Jangan Lupa Pilih Jenis Usernya Om','error').then(function(){
                    window.location = 'login.php';
                });
            </script>
        ";
    }else {

        // ambil data
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
    
        if ($_POST["user"] == "admin"){
            // cek apakah username ada
            $admin = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$username'");
            if (mysqli_num_rows($admin) > 0){
                // jika ada
                $admin = mysqli_fetch_assoc($admin);
                // cek password nya
                if (password_verify($password, $admin["password"])){
                    // jika passwd benar
                    $_SESSION["admin"] = $admin["username"];
                    echo "
                        <script>
                            Swal.fire('LOGIN BERHASIL', '','success').then(function(){
                                window.location = 'index.php';
                            });
                        </script>
                    ";
                }else {
                    // jika passwd salah
                    echo "
                        <script>
                            Swal.fire('LOGIN GAGAL', 'Password Yang Anda Masukkan Salah','warning').then(function(){
                                window.location = 'login.php';
                            });
                        </script>
                    ";
                }
            }else {
                // jika username salah
                echo "
                    <script>
                        Swal.fire('LOGIN GAGAL', 'Username Yang Anda Masukkan Salah','warning').then(function(){
                            window.location = 'login.php';
                        });
                    </script>
                ";
            }
        }else if ($_POST["user"] == "pegawai"){
            // cek apakah username ada di tabel pegawai
            $pegawai = mysqli_query($connect, "SELECT * FROM pegawai WHERE username = '$username'");
            if (mysqli_num_rows($pegawai) > 0){
                // jika ada
                $pegawai = mysqli_fetch_assoc($pegawai);
                // cek password nya
                if (password_verify($password, $pegawai["password"])){
                    // jika passwd benar
                    $_SESSION["pegawai"] = $username;
                    echo "
                        <script>
                            Swal.fire('LOGIN BERHASIL', '','success').then(function(){
                                window.location = 'index.php';
                            });
                        </script>
                    ";
                }else {
                    // jika passwd salah
                    echo "
                        <script>
                            Swal.fire('LOGIN GAGAL', 'Password Yang Anda Masukkan Salah','warning').then(function(){
                                window.location = 'login.php';
                            });
                        </script>
                    ";
                }
            }else {
                // jika username salah
                echo "
                    <script>
                        Swal.fire('LOGIN GAGAL', 'Username Tidak Ditemukan,'warning').then(function(){
                            window.location = 'login.php';
                        });
                    </script>
                ";
            }
        }
    }



}

?>