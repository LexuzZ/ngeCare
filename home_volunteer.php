<?php
session_start();

if(empty($_SESSION['username']) or empty($_SESSION['level'])){
    echo "<script>alert('Maaf, untuk mengakses halaman ini harus login dahulu');document.location='index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Volunteer</title>
    <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="jumbotron text-light bg-success">
  <h1 class="display-4">Hello, <?= $_SESSION['nama_lengkap']?></h1>
  <p class="lead">Selamat Datang, anda berhasil login sebagai <b><?= $_SESSION['level']?></b></p>
  
  <a class="btn btn-danger btn-lg" href="logout.php" role="button">Log Out</a>
</div>
    </div>
    
</body>
</html>