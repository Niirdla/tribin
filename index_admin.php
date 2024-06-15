<?php include 'inc/header_3.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Index.css">
  <title>Navbar at the Top and Centered Image Below</title>
 
</head>
<body>
<nav class="navbar">
    <div class="logo">
      <img src="pics/triBinLogo.png" alt="Logo">
      <a href="index_admin.php" class="dashboard-link">Dashboard</a>
      <a href="manageUser_Add.php" class="manage-users-link">Manage users</a>
    </div>

    <div class="nav-links">
      <a href="?cid=<?php Session::get('admId') ?>" class="sign-out">Log out</a>
    </div>
  </nav>
  <div class="box">
    <div class="crop ratio ratio-1:1">
      <iframe src="https://create.arduino.cc/iot/dashboards/032bf115-a096-48f1-a1b6-f08ca6432c28?mode=edit" height="720" width="960" title="Iframe Example"></iframe>
    </div>
  </div>
</body>
</html>