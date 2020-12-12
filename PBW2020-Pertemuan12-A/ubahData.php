<?php

// mulai session
session_start();
// panggil koneksi db
require "connectDB.php";
// panggil fungsi
require "functions.php";

//  ambil data melalui method get
$nim = $_GET["nim"];
$mahasiswa = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM mahasiswa WHERE nim = '$nim'"));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- panggil headtags -->
    <?php require "headtags.html" ?>
    <!-- judul -->
    <title>Ubah Data Mahasiswa</title>
</head>
<body>
    <!-- navbar -->
    <?php require "navbar.php" ?>

    <!-- form -->
    <div class="row mt-5" data-aos="fade-down" data-aos-duration="2000">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Ubah Data Mahasiswa</h3>
                </div>
                <div class="card-body text-center">
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nim" placeholder="NIM" value="<?= $mahasiswa['nim'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= $mahasiswa['nama'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="prodi" placeholder="Program Studi" value="<?= $mahasiswa['prodi'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="fakultas" placeholder="Fakultas" value="<?= $mahasiswa['fakultas'] ?>">
                        </div>
                        <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"><?= $mahasiswa['alamat'] ?></textarea>
                        <button type="submit" class="btn btn-primary mt-1" name="simpanData">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.html" ?>


</body>
</html>

<?php

// jika belum login, tendang ke login.php
if (!(isset($_SESSION["admin"]) || isset($_SESSION["pegawai"]))) {
    echo "
        <script>
            Swal.fire('AKSES DITOLAK', 'Anda Salah Tempat Bro','warning').then(function(){
                window.location = 'login.php';
            });
        </script>
    ";
}

// jika form sudah di isi
if (isset($_POST["simpanData"])){
    // tangkap semua nilai form
    $nim2 = htmlspecialchars($_POST["nim"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $prodi = htmlspecialchars($_POST["prodi"]);
    $fakultas = htmlspecialchars($_POST["fakultas"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    // validasi form
    if(validasiNIM($nim) == true){
        if (validasiNama($nama) == true){
            if (validasiProdi($prodi) == true){
                if (validasiFakultas($fakultas) == true){
                    if (validasiAlamat($alamat) == true){
                        // jika berhasil melewati semua validasi
                        // update db
                        $push = mysqli_query($connect, "UPDATE mahasiswa SET nim = '$nim2', nama = '$nama', prodi = '$prodi', fakultas = '$fakultas', alamat = '$alamat' WHERE nim = '$nim'");
                        // jika berhasil di ubah
                        if (mysqli_affected_rows($connect) > 0) {
                            echo "
                                <script>
                                    Swal.fire('Input Data Berhasil','','success').then(function(){
                                        window.location = 'index.php';
                                    });
                                </script>
                            ";
                        }else {
                            // jika gagal di ubah, tampilkan pesan error
                            echo mysqli_error($connect);
                        }
                    }
                }
            }
        }
    }

}

?>