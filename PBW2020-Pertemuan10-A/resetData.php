<?php

// mulai session
session_start();
// hapus session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- tag Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- judul -->
    <title>Reset Data</title>

    <!-- ambil isi headtags.php -->
    <?php require "headtags.php" ?>
    
</head>

<!-- Ganti font -->
<body style="font-family: 'Lato', sans-serif;">

    <script>
        // alert
        Swal.fire(
            'SUCCESS !',
            'Data Mahasiswa Berhasil Di Reset',
            'success'
        ).then(function (result) {
            if (result.value) {
                window.location = 'index.php';
            }
        })
    </script>
</body>
</html>

