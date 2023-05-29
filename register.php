<?php

include "koneksi.php";

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($koneksi, $_POST['username']);
   $name = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $level = $_POST['level'];

   $select = " SELECT * FROM tuser WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($koneksi, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO tuser(username, nama_lengkap, password, level) VALUES('$username', '$name', '$pass','$level')";
         mysqli_query($koneksi, $insert);
         header('location:index.php');
      }
   }

};


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>ngeCare</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

  <!-- Bootstrap core CSS -->
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
     
  </style>
  <!-- Custom styles for this template -->
  <link href="assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="enter your username">
      <input type="text" name="nama_lengkap" required placeholder="enter your name">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select class="form-control" name="level">
        <option value="Volunteer">Volunteer</option>
        <option value="Patient">Patient</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="index.php">login now</a></p>
   </form>

</div>

</body>

</html>