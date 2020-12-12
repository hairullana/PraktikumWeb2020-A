<?php

// mulai session
session_start();
// panggil koneksi db
require "connectDB.php";
// Function
require 'functions.php';

//konfirgurasi pagination
$jumlahDataPerHalaman = 5;
$jumlahData = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mahasiswa"));
//ceil() = pembulatan ke atas
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
//menentukan halaman aktif
//$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
if ( isset($_GET["page"])){
    $halamanAktif = $_GET["page"];
}else{
    $halamanAktif = 1;
}
//data awal
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

//fungsi memasukkan data di db ke array
$mahasiswa = mysqli_query($connect,"SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");
//$buku = query("SELECT * FROM buku");

?>


<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul -->
    <title>Data Mahasiwa</title>

    <!-- ambil isi headtags.html -->
    <?php require "headtags.html" ?>


</head>

<!-- ganti font -->
<body style="font-family: 'Lato', sans-serif;">


    <!-- navbar -->
    <?php require "navbar.php" ?>

    <!-- tambahData -->
    <div class="row" data-aos="fade-down" data-aos-duration="1000">
        <div class="col-md-2 offset-md-1 mt-5">
            <a class="btn btn-primary" href="inputData.php"><i class="fa fa-user-plus"></i> Input Data</a>
        </div>
    </div>
    <!-- end tambahData -->

    <!-- jika session jumlah data > 0 -->
    <?php if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mahasiswa")) > 0) : ?>

        <!-- jika sudah login admin -->
        <?php if(isset($_SESSION["admin"])) : ?>
        
            <!-- tampilkan data mhs beserta tombol aksi -->
            <!-- Data Mahasiswa -->
            <div class="container mt-4" data-aos="fade-down" data-aos-duration="1000">
                <div class="row">
                    <div class="col">
                        <table class="table text-center">
                            <tr class="bg-dark text-white">
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Fakultas</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                                foreach ($mahasiswa as $data) :
                            ?>
                                <tr>
                                    <td><?= $data["nim"] ?></td>
                                    <td><?= $data["nama"] ?></td>
                                    <td><?= $data["prodi"] ?></td>
                                    <td><?= $data["fakultas"] ?></td>
                                    <td><?= $data["alamat"] ?></td>
                                    <td><a href="ubahData.php?nim=<?= $data['nim'] ?>" class="btn btn-primary mt-1"><i class="fa fa-edit"></i></a> <a href="hapusData.php?nim=<?= $data['nim'] ?>" class="btn btn-danger mt-1"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif (isset($_SESSION["pegawai"])) : ?>
            <!-- tampilkan data mhs beserta tombol aksi -->
            <!-- Data Mahasiswa -->
            <div class="container mt-4" data-aos="fade-down" data-aos-duration="1000">
                <div class="row">
                    <div class="col">
                        <table class="table text-center">
                            <tr class="bg-dark text-white">
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Fakultas</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                                foreach ($mahasiswa as $data) :
                            ?>
                                <tr>
                                    <td><?= $data["nim"] ?></td>
                                    <td><?= $data["nama"] ?></td>
                                    <td><?= $data["prodi"] ?></td>
                                    <td><?= $data["fakultas"] ?></td>
                                    <td><?= $data["alamat"] ?></td>
                                    <td><a href="ubahData.php?nim=<?= $data['nim'] ?>" class="btn btn-primary mt-1"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php else : ?>     
            <!-- jika belum login admin -->
            <!-- tampilkan data mhs -->
            <!-- Data Mahasiswa -->
            <div class="container mt-4" data-aos="fade-down" data-aos-duration="1000">
                <div class="row">
                    <div class="col">
                        <table class="table text-center">
                            <tr class="bg-dark text-white">
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Fakultas</th>
                                <th>Alamat</th>
                            </tr>
                            <?php
                                foreach ($mahasiswa as $data) :
                            ?>
                                <tr>
                                    <td><?= $data["nim"] ?></td>
                                    <td><?= $data["nama"] ?></td>
                                    <td><?= $data["prodi"] ?></td>
                                    <td><?= $data["fakultas"] ?></td>
                                    <td><?= $data["alamat"] ?></td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <!-- pagination -->
        <div class="row">
            <div class="col">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <?php if( $halamanAktif > 1 ) : ?>
                                <a class="page-link" href="?page=<?= $halamanAktif - 1; ?>"><i class="fa fa-chevron-left"></i></a>
                            <?php endif; ?>
                        </li>
                        <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                            <?php if( $i == $halamanAktif ) : ?>
                                <li class="active">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>   
                            <?php endif; ?>
                        <?php endfor; ?>
                        <li class="page-item">
                            <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                                <a class="page-link" href="?page=<?= $halamanAktif + 1; ?>"><i class="fa fa-chevron-right"></i></a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- end pagination -->
    
    <?php else : ?>
        <!-- jika belum ada data -->
        <h3 class="display-4 text-center my-5" data-aos="fade-down" data-aos-duration="1000">Belum Ada Data</h3>

    <?php endif; ?>




    <!-- footer -->
    <?php require "footer.html" ?>

</body>
</html>