<?php

// mulai session
session_start();
// panggil fungsi
require "functions.php";
// panggil koneksi db
require "connectDB.php";

// ambil data akun admin atau pegawai
if(isset($_SESSION["admin"])){
    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM admin"));
}else if(isset($_SESSION["pegawai"])) {
    $username = $_SESSION["pegawai"];
    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM pegawai where username = '$username'"));
}

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
    <div class="row mt-5" data-aos="fade-down" data-aos-duration="2000">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Profil Admin</h3>
                </div>
                <div class="card-body text-center">
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="password" name="passwordLama" placeholder="Password Lama" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwordBaru1" placeholder="Password Baru" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwordBaru2" placeholder="Ulang Password Baru" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="gantiPassword">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.html" ?>


</body>
</html>

<?php

// jika dilakukan perubahan
if (isset($_POST["gantiPassword"])){
    // tangkap value form
    $passwordLama = htmlspecialchars($_POST["passwordLama"]);
    $passwordBaru1 = htmlspecialchars($_POST["passwordBaru1"]);
    $passwordBaru2 = htmlspecialchars($_POST["passwordBaru2"]);

    // cek apakah password lama sudah sesuai
    if(!password_verify($passwordLama, $user["password"])){
        echo "
            <script>
                Swal.fire('Update Profil Gagal','Password Lama Salah','error').then(function(){
                    window.location = 'gantiPassword.php';
                });
            </script>
        ";
    }else if ($passwordBaru1 != $passwordBaru2){        // cek apakah password baru sama
        echo "
            <script>
                Swal.fire('Update Profil Gagal','Password Baru Tidak Sama','error').then(function(){
                    window.location = 'gantiPassword.php';
                });
            </script>
        ";
    }else {     // jika berhasil melewati 2 pengecekan
        // validasi
        if (validasiPassword($passwordBaru1) == true){
            $password = password_hash($passwordBaru1, PASSWORD_DEFAULT);
            if(isset($_SESSION["admin"])){
                mysqli_query($connect,"UPDATE admin SET password = '$password'");
            }else if(isset($_SESSION["pegawai"])) {
                $username = $_SESSION["pegawai"];
                mysqli_query($connect,"UPDATE pegawai SET password = '$password' where username = '$username'");
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


}

?>