<?php

session_start();

// Function
require 'functions.php';

// jika belum ada session, atur jumlah data = 0 di session
if (!isset($_SESSION["jumlahData"])) {
    $_SESSION["jumlahData"] = 0 ;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul -->
    <title>Nilai Mahasiwa</title>

    <!-- ambil isi headtags.php -->
    <?php require "headtags.php" ?>


</head>

<!-- ganti font -->
<body style="font-family: 'Lato', sans-serif;">

    <?php

        // jika data ditambahkan
        if (isset($_POST["tambahData"])){
            // ambil semua nilai dari method post
            $nim = htmlspecialchars($_POST["nim"]);
            $nama = htmlspecialchars($_POST["nama"]);
            $uts = htmlspecialchars($_POST["uts"]);
            $uas = htmlspecialchars($_POST["uas"]);

            // validasi
            if (validasiNIM($nim) == true){
                if (validasiNama($nama) == true){
                    if (validasiNilai($uts) == true){
                        if (validasiNilai($uas) == true){
                            // jika berhasil melewati semua validasi, masukkan data ke session
                            $n = $_SESSION["jumlahData"];
                            $_SESSION["nim$n"] = $nim;
                            $_SESSION["nama$n"] = $nama;
                            $_SESSION["uts$n"] = $uts;
                            $_SESSION["uas$n"] = $uas;
                            $_SESSION["jumlahData"] = $_SESSION["jumlahData"]+1;
                            // alert
                            echo "
                                <script>
                                    Swal.fire(
                                        'SUCCESS !',
                                        'Data Berhasil Ditambahkan',
                                        'success'
                                    ).then(function (result) {
                                        if (result.value) {
                                            window.location = '#';
                                        }
                                    })
                                </script>
                            ";
                        }
                    }
                }
            }
            
        }

    ?>


    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Brand Name -->
            <a class="navbar-brand" data-aos="fade-right" data-aos-duration="2000" href="index.php"><i class="fa fa-home"></i> Nilai Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Link Navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav" data-aos="fade-left" data-aos-duration="2000">
                    <!-- input Data -->
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#"><i class="fa fa-user"></i> Input Data</a>
                    </li>
                    <!-- reset data -->
                    <li class="nav-item active">
                        <a class="nav-link" href="resetData.php" name="resetData"><i class="fa fa-trash"></i> Reset Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- jika session jumlah data > 0 -->
    <?php if ($_SESSION["jumlahData"] > 0) : ?>
        
        <!-- tampilkan data mhs -->
        <!-- Data Mahasiswa -->
        <div class="container mt-4" data-aos="fade-down" data-aos-duration="2000">
            <div class="row">
                <div class="col">
                    <h3 class="display-4 text-center mb-4">Data Mahasiswa</h3>
                    <table class="table text-center">
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Jumlah Nilai</th>
                            <th>Rata-Rata</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        <!-- perulangan untuk menampilkan semua data -->
                        <?php $n=0; ?>
                        <?php for ($i=0;$i<$_SESSION["jumlahData"];$i++) : ?>
                            <!-- jika session nim bukan 0, maka tampilkan data -->
                            <?php if ($_SESSION["nim$i"] != 0) : ?>
                                <tr>
                                    <!-- untuk penomoran saja -->
                                    <td><?php $n++; echo $n; ?></td>
                                    <!-- nama -->
                                    <td><?= $_SESSION["nama$i"]; ?></td>
                                    <!-- nim -->
                                    <td><?= $_SESSION["nim$i"]; ?></td>
                                    <!-- uts -->
                                    <td><?= $_SESSION["uts$i"]; ?></td>
                                    <!-- uas -->
                                    <td><?= $_SESSION["uas$i"]; ?></td>
                                    <!-- jumlah nilai -->
                                    <td><?= $_SESSION["uts$i"] + $_SESSION["uas$i"] ?></td>
                                    <!-- rata-rata -->
                                    <td><?= $rata = ($_SESSION["uts$i"] + $_SESSION["uas$i"]) / 2 ?></td>
                                    <!-- keterangan -->
                                    <td>
                                        <?php
                                            if ($rata <= 44) {
                                                echo "E (Tidak Lulus)";
                                            }else if ($rata <= 50) {
                                                echo "D (Tidak Lulus)";
                                            }else if ($rata <= 55) {
                                                echo "D+ (Tidak Lulus)";
                                            }else if ($rata <= 60) {
                                                echo "C (Lulus)";
                                            }else if ($rata <= 64) {
                                                echo "C+ (Lulus)";
                                            }else if ($rata <= 70) {
                                                echo "B (Lulus)";
                                            }else if ($rata <= 79) {
                                                echo "B+ (Lulus)";
                                            }else {
                                                echo "A (Lulus)";
                                            }
                                        ?>
                                    </td>
                                    <!-- hapus data -->
                                    <td><a href="hapusData.php?id=<?= $i ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </table>
                </div>
            </div>
        </div>
    
    <?php else : ?>


    <h3 class="display-4 text-center my-5" data-aos="fade-down" data-aos-duration="2000">Belum Ada Data</h3>

    <?php endif; ?>




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" value="<?= $jumlahData++ ?>" name="jumlahData">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nim" placeholder="NIM">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="uts" placeholder="Nilai UTS">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="uas" placeholder="Nilai UAS">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="tambahData">Tambah Data</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 bg-primary text-white" id="down">
        <div class="card-footer bg-primary text-white text-center" data-aos="fade-right" data-aos-duration="2000">
            Built with <i class="fa fa-heart"></i> by Hairul Lana
        </div>
    </div>
    <!-- end footer -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>

        <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- inisialisasi aos -->
    <script>
        AOS.init();
    </script>

</body>
</html>