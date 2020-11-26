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
    }else if (is_numeric($nim) == FALSE){
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
    }

    // return true
    return true;
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
    }

    // return true
    return true;
}


// validasi Nilai
function validasiNilai($nilai){
    // cek apakah nilai kosong
    if (empty($nilai)){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Anda Belum Memasukkan Nilai',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    // cek apakah nilai bukan angka
    }else if (is_numeric($nilai) == FALSE){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Nilai Harus Berupa Angka',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    // cek apakah nilai > 100
    }else if ($nilai < 0){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Nilai Minimal Adalah 0',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    }else if ($nilai > 100){
        echo "
            <script>
                Swal.fire(
                    'ERROR !',
                    'Nilai Maksimal Adalah 100',
                    'error'
                ).then(function (result) {
                    if (result.value) {
                        window.location = '#';
                    }
                })
            </script>
        ";
        return false;
    }

    // return true
    return true;
}

?>