 <?php
require("../Koneksi.php");
require ("../sender/phpmailer.php");
require ('../vendor/autoload.php'); 

// Menerima data dari aplikasi Android
$username = $_POST['username']; // 'email' harus sesuai dengan key yang dikirim dari Android
$nama = $_POST['nama']; // 'password' harus sesuai dengan key yang dikirim dari Android
$email = $_POST['email'];
$kode_otp = mt_rand(100000, 999999);



// periksa  apakah email sudah terdaftar 
$perintah = "SELECT * FROM `akun_user` WHERE username = '$username';";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_num_rows($eksekusi);

$response = array();

if ($cek > 0) {
    $response["kode"]=0;
    $response["pesan"] = "email sudah terdaftar";

    $data = mysqli_fetch_assoc($eksekusi);
    
   

    } else {
        $type="Register";
        $mail = new EmailSender();
        $mail->sendEmail($email, $type, $kode_otp);
        
        // jika username belum terdaftar, lakukan proses registrasi
        $perintah = "INSERT INTO `akun_user`(`username`, `email`, `nama`, `kode_otp`) 
        VALUES ('$username','$email','$nama','$kode_otp')";
        $eksekusi = mysqli_query($konek, $perintah);

        


        // $F["username"] = $username;
        // array_push($response["data"], $F);

        if($eksekusi){
            $response["kode"] =1;
            $response["pesan"] = "registrasi berhasil";
        }else {
            $response["kode"]= 2;
            $response["pesan"] = "Registrasi gagal";
        }
    }


echo json_encode($response);
mysqli_close($konek);
?>