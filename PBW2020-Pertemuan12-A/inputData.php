<?php

// mulai session
session_start();
// panggil koneksi db
require "connectDB.php";
// Function
require 'functions.php';


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

    <div class="row mt-5" data-aos="fade-down" data-aos-duration="2000">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Tambah Data Mahasiswa</h3>
                </div>
                <div class="card-body text-center">
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" name="nim" placeholder="NIM" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama" placeholder="Nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="prodi" placeholder="Program Studi" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="fakultas" placeholder="Fakultas" class="form-control">
                        </div>
                        <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"></textarea>
                        <button type="submit" class="btn btn-primary mt-1" name="tambahData">Simpan Data</button>
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

// jika belum login, tendang ke login.php
if (!(isset($_SESSION["admin"]) || isset($_SESSION["pegawai"]))) {
    echo "
        <script>
            Swal.fire('ANDA BUKAN ADMIN', 'Silahkan Login Terlebih Dahulu','warning').then(function(){
                window.location = 'login.php';
            });
        </script>
    ";
}

// jika form sudah di isi
if (isset($_POST["tambahData"])){
    // tangkap semua nilai form
    $nim = htmlspecialchars($_POST["nim"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $prodi = htmlspecialchars($_POST["prodi"]);
    $fakultas = htmlspecialchars($_POST["fakultas"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    // cek apakah nim sudah pernah di inputkan
    if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mahasiswa WHERE nim = '$nim'")) > 0){
        echo "
            <script>
                Swal.fire('Input Data Gagal','NIM Sudah Pernah Di Inputkan','success').then(function(){
                    window.location = 'inputData.php';
                });
            </script>
        ";
    }else {
        // validasi form
        if(validasiNIM($nim) == true){
            if (validasiNama($nama) == true){
                if (validasiProdi($prodi) == true){
                    if (validasiFakultas($fakultas) == true){
                        if (validasiAlamat($alamat) == true){
                            // jika berhasil melewati semua validasi
                            $push = mysqli_query($connect, "INSERT INTO mahasiswa VALUES ('$nim','$nama','$prodi','$fakultas','$alamat')");
                            // cek apakah sdh masuk db
                            if (mysqli_affected_rows($connect) > 0) {
                                echo "
                                    <script>
                                        Swal.fire('Input Data Berhasil','','success').then(function(){
                                            window.location = 'index.php';
                                        });
                                    </script>
                                ";
                            }else {
                                // jika tdk masuk db, tampilkan pesan error
                                echo mysqli_error($connect);
                            }
                        }
                    }
                }
            }
        }
    }

}

?>