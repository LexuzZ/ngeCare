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
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
  <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
</head>

<body>
  <form class="form-signin" method="POST" action="cek_login.php">
    <div class="text-center mb-4">
      <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Form Login</h1>
      <p>Masukkan Username dan Password anda dengan benar</p>

    </div>

    <div class="form-label-group">
      <input type="text" class="form-control" name="username" placeholder="Username address" required autofocus>
      <label>Username address</label>
    </div>

    <div class="form-label-group">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <label>Password</label>
    </div>
    <div class="form-label-group">
      <select class="form-control" name="level">
        <option value="Volunteer">Volunteer</option>
        <option value="Patient">Patient</option>
      </select>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <a href="register.php" class="btn btn-lg btn-primary btn-block" >Register</a>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2023-<?=date('Y')?></p>
  </form>
</body>

</html>