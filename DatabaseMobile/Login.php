<?php
require('Koneksi.php');

// Menerima data dari aplikasi Android
$username = $_POST['username']; // 'username' harus sesuai dengan key yang dikirim dari Android
$password = $_POST['password'];
$hashedPassword = md5($password); // 'password' harus sesuai dengan key yang dikirim dari Android

$perintah = "SELECT * FROM `akun_user` WHERE username = '$username'";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_num_rows($eksekusi);

$response = array();

if ($cek > 0) {
    $ambil = mysqli_fetch_object($eksekusi);
    $password_db = $ambil->password;

    if ($hashedPassword == $password_db) {
        // Password benar
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();
        $data["username"] = $ambil->username;
        $data["email"] = $ambil->email;
        $data["nama"] = $ambil->nama;
        $data["kode_otp"] = $ambil->kode_otp;
        array_push($response["data"], $data);
    } else {
        // Password salah
        $response["kode"] = 2;
        $response["pesan"] = "Password Salah";
    }
} else {
    // Username tidak ditemukan di database
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Tersedia";
}
// echo "Input Password: $password<br>";
// echo "Hash from Database: $password_db<br>";


echo json_encode($response);
mysqli_close($konek);
?>
