<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $password = $_POST["password"];

    // Mengenkripsi password yang diinputkan menggunakan MD5
    $password_md5 = md5($password);

    $query = "SELECT username as id FROM akun_admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $user, $password_md5);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];

        session_start();
        $_SESSION['username'] = $id;

        header("location: dashboard.php");
    } else {
        header("location: login.php?error=1");
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
exit();
?>
