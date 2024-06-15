<?php include 'inc/header_3.php';?>
<?php require_once "controllerUserData.php"; ?>
<?php 
$login = Session::get("userlogin");

 ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $userLogin = $cmr->userLogin($_POST);
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Login Page</title>
</head>
<body>
  <div class="container">
    <form class="login-form" action="" method="post">
    <div class="image-container">
        <img src="pics/NULogo.png" alt="Login Image" class="main-image">
        <img src="pics/triBinLogo.png" alt="New Image" class="new-image">
      </div>
      <h2>Login</h2>

      <?php 

      if (isset($userLogin)) {
        echo $userLogin;
      }
      ?>
      <label for="email">Email: <span style="color: red;">*</span></label>
      <input type="text" id="username" name="email" placeholder="Enter your email">
      <label for="password"  type="password">Password: <span style="color: red;">*</span></label>
      <input type="password" id="password" name="pass" placeholder="Enter your password">
      <div><button class="submit" type="submit" name="login">Log In</button></div>
    </form>
  </div>
</body>
</html>