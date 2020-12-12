<?php

// mulai session
session_start();
// panggil koneksi db
require "connectDB.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Tag Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul -->
    <title>Hapus Data</title>

    <!-- ambil isi headtags.html -->
    <?php require "headtags.html" ?>

</head>

<!-- Ganti font -->
<body style="font-family: 'Lato', sans-serif;">

</body>
</html>


<?php

    // jika belum login, tendang ke login.php
    if (isset($_SESSION["admin"])) {
        // ambil id
        $nim = $_GET["nim"];

        // cari apakah ada nim yg sdh terdaftar di db
        $hapus = mysqli_query($connect,"DELETE FROM mahasiswa WHERE nim = '$nim'");
        if (mysqli_affected_rows($connect) == 1){
            // berhasil di hapus
            echo "
                <script>
                    Swal.fire('Data Berhasil Di Hapus','','success').then(function(){
                        window.location = 'index.php';
                    });
                </script>
            ";
        }else{      // jika tidak ada nim yg terdaftar di db
            echo "
                <script>
                    Swal.fire('Data Gagal Di Hapus','NIM Tidak Ditemukan','error').then(function(){
                        window.location = 'index.php';
                    });
                </script>
            ";
        }    
    }else {
        // jika bukan admin
        echo "
            <script>
                Swal.fire('ANDA BUKAN ADMIN', 'Silahkan Login Terlebih Dahulu','warning').then(function(){
                    window.location = 'login.php';
                });
            </script>
        ";
    }

    
?>