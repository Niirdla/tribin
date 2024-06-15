<?php include 'inc/header_2.php';?>
<?php include 'classess/Customer.php';?>


<?php

if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
   
   echo "<script>window.location='userlist.php';</script>";
   
} else {

    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['userid']);
}
$pd = new Customer();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateUser = $pd->customerUpdate($_POST,$_FILES,$id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index_user.css">
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
     /* Apply styles for the form card */
     .card {
        width: 50%;
        margin: 0 auto;
        margin-top: 50px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Apply styles for the form */
    .form-group {
        margin: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
    }

    .form-group button {
        padding: 10px 20px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    /* Apply styles for the table */
    #example {
        width: 90%;
        margin: 0 auto;
        margin-top: 20px;
        border-collapse: collapse;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #example th, #example td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    #example th {
        background-color: #f2f2f2;
    }

    /* Apply styles for table actions */
    .table-actions a {
        color: #007BFF;
        text-decoration: none;
        margin-right: 10px;
    }

    .table-actions a:hover {
        text-decoration: underline;
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
        if (isset($updateUser)) {
            echo $updateUser;
        }

        ?> 

        <?php 
        $getUser = $pd->getCustomerData($id);
        if ($getUser) {
           while ($value = $getUser->fetch_assoc()) {
               
    
         ?>
          <a href="userlist.php" style="font-size: 18px;">Back</a>             
         <h2> Edit user information </h2>
         <form action="" method="post" enctype="multipart/form-data">
    <table class="form-table">
        <tr>
            <td>
                <label for="first_name">First Name <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="text" id="first_name" name="first_name" placeholder="Enter First Name..." value="<?php echo $value['first_name'];?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="last_name">Last Name <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name..." value="<?php echo $value['last_name'];?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email <span style="color: red;">*</span></label>
            </td>
            <td>
                <input type="text" id="email" name="email" placeholder="Enter Email..." value="<?php echo $value['email'];?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="role">Role <span style="color: red;">*</span></label>
            </td>
            <td>
                <select id="role" name="role">
                    <option>Select Type</option>
                    <?php if ($value['role'] == 'Admin') { ?>
                        <option selected="selected" value="Admin">Admin</option>
                        <option value="User">User</option>
                    <?php } else { ?>
                        <option selected="selected" value="User">User</option>
                        <option value="Admin">Admin</option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Update" />
            </td>
        </tr>
    </table>
</form>
            <?php } } ?>
</div>

</body>
</html>



<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->

<?php include 'inc/scripts.php'; ?>


