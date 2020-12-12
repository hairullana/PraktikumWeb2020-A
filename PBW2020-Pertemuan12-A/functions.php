<?php


// validasi nim
function validasiNIM($nim){
    // cek apakah kosong
    if (empty($nim)){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Anda Belum Menginputkan NIM',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    // cek apakah bukn angka
    }else if (!is_numeric($nim)){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Inputan NIM Harus Angka',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    // cek apakah karakter nim > 10
    }else if(strlen($nim) > 10){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'NIM Terlalu Panjang',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    }else{
        // return true
        return true;
    }

}



// validasi nama
function validasiNama($nama){
    // cek apakah kosong
    if (empty($nama)){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Anda Belum Menginputkan Nama',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    // cek apakah panjang nama <3
    }else if (strlen($nama) < 3){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Nama Terlalu Pendek',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    // cek apakah panjang nama > 30
    }else if (strlen($nama > 30)){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Nama Terlalu Panjang',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    }else{
        // return true
        return true;
    }

}


// validasi prodi
function validasiProdi($data){
    if (empty($data)){      // jika data kosong
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Program Studi Belum Di Isi','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) < 5){       // jika data kurang dari 5 karakter
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Program Studi Terlalu Pendek','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) > 30) {     // jika data lebih dari 30 karakter
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Program Studi Terlalu Panjang','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else{      // jika berhasil melewati semua validasi
        return true;
    }
}

// validasi fakultas
function validasiFakultas($data){
    if (empty($data)){      // jika data kosong
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Fakultas Belum Di Isi','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) < 4){       // jika data kurang dari 5 karakter
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Fakultas Terlalu Pendek','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) > 30) {     // jika data lebih dari 30 karakter
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Fakultas Terlalu Panjang','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else{      // jika berhasil melewati semua validasi
        return true;
    }
}

// validasi alamat
function validasiAlamat($data){
    if (empty($data)){      // jika data kosong
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Alamat Belum Di Isi','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) < 10){       // jika data kurang dari 5 karakter
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Alamat Terlalu Pendek','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) > 100) {     // jika data lebih dari 30 karakter
        echo "
            <script>
                Swal.fire('INPUT DATA GAGAL', 'Form Alamat Terlalu Panjang','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else{      // jika berhasil melewati semua validasi
        return true;
    }
}


// validasi username
function validasiUsername($data){
    if (empty($data)){
        echo "
            <script>
                Swal.fire('FORM ERROR','Form Username Kosong','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) < 3){
        echo "
            <script>
                Swal.fire('FORM ERROR','Form Username Terlalu Pendek','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) > 16){
        echo "
            <script>
                Swal.fire('FORM ERROR','Form Username Terlalu Panjang','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else if (!preg_match("/^[a-zA-Z0-9]*$/", $data)){
        echo "
            <script>
                Swal.fire('FORM ERROR','Username Hanya Diperbolehkan Huruf dan Angka','error').then(function(){
                    window.location = '#';
                });
            </script>
        ";
        return false;
    }else {
        return true;
    }
}

// validasi password
function validasiPassword($data){
    if (empty($data)){
        echo "
            <script>
                Swal.fire('FORM ERROR','Form Password Kosong','error').then(function(){
                    window.location = 'gantiPassword.php';
                });
            </script>
        ";
        return false;
    }else if (strlen($data) < 3){
        echo "
            <script>
                Swal.fire('FORM ERROR','Form Password Terlalu Pendek','error').then(function(){
                    window.location = 'gantiPassword.php';
                });
            </script>
        ";
        return false;
    }else {
        return true;
    }
}


?>