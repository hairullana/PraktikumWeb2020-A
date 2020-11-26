<?php
// mulai session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Tag Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul -->
    <title>Reset Data</title>

    <!-- ambil isi headtags.php -->
    <?php require "headtags.php" ?>

</head>

<!-- Ganti font -->
<body style="font-family: 'Lato', sans-serif;">

    <?php
        // ambil id
        $id = $_GET["id"];
        // ganti session nim jadi 0
        $_SESSION["nim$id"] = 0;
    ?>

    <script>
        // alert
        Swal.fire(
            'SUCCESS !',
            'Data Mahasiswa Berhasil Di Hapus',
            'success'
        ).then(function (result) {
            if (result.value) {
                window.location = 'index.php';
            }
        })
    </script>
</body>
</html>

