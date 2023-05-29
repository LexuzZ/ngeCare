<?php

include "koneksi.php";

$pass = md5($_POST['password']);
$username = mysqli_escape_string($koneksi, $_POST['username']);
$level = mysqli_escape_string($koneksi, $_POST['level']);
$password = mysqli_escape_string($koneksi, $pass);

// cek username
$cek_user = mysqli_query($koneksi, "SELECT * FROM tuser where username = '$username' and level = '$level' ");
$user_valid = mysqli_fetch_array($cek_user);

// uji jika user terdaftar
if($user_valid){
    if($password == $user_valid['password']){
        session_start();
        $_SESSION['username'] = $user_valid['username'];
        $_SESSION['nama_lengkap'] = $user_valid['nama_lengkap'];
        $_SESSION['level'] = $user_valid['level'];

        // uji level user
        if($level == "Volunteer"){
            header('location:home_volunteer.php');
        }elseif($level == "Patient"){
            header('location:home_user.php');
        }
    }else{
        echo "<script>alert('Maaf, Login Gagal, Password anda tidak sesuai!');document.location='index.php'</script>";
    }
}else{
    echo "<script>alert('Maaf, Login Gagal, Username anda tidak terdaftar!');document.location='index.php'</script>";
}
?>