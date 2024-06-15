<?php include 'inc/header_2.php';?>
<?php include 'classess/Customer.php';?>

<?php
$pd = new Customer();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertUser = $pd->AdmincustomerRegistration($_POST,$_FILES);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Index.css">
  <style>
    /* Add some basic styling for the sidebar */
    .sidebar {
      height: 100%;
      width: 200px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: white;
      overflow-x: hidden;
      padding-top: 20px;
      margin-top: 90px;
    }

    /* Style the links */
    .sidebar a {
      padding: 8px 16px;
      text-decoration: none;
      font-size: 18px;
      color: black;
      display: block;
      margin-bottom: 20px;
    }

    /* Change color on hover */
    .sidebar a:hover {
      color: #f1f1f1;
    }

    /* New style for the content div */
    .content {
  margin-left: 210px; /* Adjust based on the width of the sidebar */
  margin-top: 10px; /* Add space below the navbar */
  padding: 20px;
  background-color: white;
  border: 1px solid #ccc; /* Add a border for visual separation */
  min-height: calc(100vh - 100px); /* Adjust the min-height to leave space at the bottom */
  display: flex;
  flex-direction: column;
}

    .content input {
      margin-top: 10px; /* Add space between the text and input */
    }

        /* Apply styles for the form table */
        .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px; /* Adjust the margin as needed */
    }

    /* Apply styles for table cells (td) */
    .form-table td {
        padding: 10px; /* Adjust the padding as needed */
        border: 1px solid #ccc; /* Add borders for the cells */
    }

    /* Apply styles for labels */
    .form-table label {
        display: block;
        margin-bottom: 5px; /* Adjust the margin as needed */
    }

    /* Apply styles for input fields and select */
    .form-table input, .form-table select {
        width: 100%;
        padding: 5px;
    }

  </style>
  <title>Navbar at the Top and Centered Image Below</title>
</head>
<body>

<div class="sidebar">
  <a href="manageUser_Add.php" class="add-user-link">Add user</a>
  <a href="manageUser_Edit.php" class="edit-user-link">Edit user</a>

</div>

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

<div class="content">
<?php
        if (isset($insertUser)) {
            echo $insertUser;
        }

        ?> 
        <h2> Add User </h2>                         
        <form action="" method="post" enctype="multipart/form-data">
    <table class="form-table">
        <tr>
            <td>
                <label for="first_name">First Name <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="text" id="first_name" name="first_name" placeholder="Enter First Name..." />
            </td>
        </tr>
        <tr>
            <td>
                <label for="last_name">Last Name <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name..." />
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="text" id="email" name="email" placeholder="Enter Email..." />
            </td>
        </tr>
        <tr>
            <td>
                <label for="pass">Password <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="password" id="pass" name="pass" placeholder="Enter Password..." />
            </td>
        </tr>
        <tr>
            <td>
                <label for="role">Role <span style="color: red;">*</span></label>
            </td>
            <td>
                <select id="role" name="role">
                    <option>Select role</option>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Save" />
            </td>
        </tr>
    </table>
</form>
</div>

</body>
</html>


