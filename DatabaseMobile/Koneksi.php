<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "elades";



// $servername = "103.247.11.134"; 
// $username = "tifz1761_root"; 
// $password = "tifnganjuk321"; 
// $database = "tifz1761_elades"; 


// Membuat koneksi
$konek = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($konek->connect_error) {
    die("Koneksi gagal: " . $konek->connect_error);
}


?>