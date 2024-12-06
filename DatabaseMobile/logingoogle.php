<?php
require('Koneksi.php');

// Menerima data dari aplikasi Android
$email = $_POST['email']; // 'username' harus sesuai dengan key yang dikirim dari Android

$perintah = "SELECT * FROM `akun_user` WHERE email = '$email'";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_num_rows($eksekusi);

$response = array();

if ($cek > 0) {
    $ambil = mysqli_fetch_object($eksekusi);


    // Password benar
    $response["kode"] = 1;
    $response["pesan"] = "Akun Terdaftar";
    $response["data"] = array();
    $data["username"] = $ambil->username;
    $data["email"] = $ambil->email;
    $data["nama"] = $ambil->nama;
    $data["kode_otp"] = $ambil->kode_otp;
    array_push($response["data"], $data);

} else {
    // Username tidak ditemukan di database
    $response["kode"] = 0;
    $response["pesan"] = "Akun Tidak Terdaftar Silahkan Register";
}
echo json_encode($response);
mysqli_close($konek);
?>