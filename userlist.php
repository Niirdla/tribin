<?php include 'inc/header_2.php';?>
<?php include 'classess/Customer.php';?>
<?php include_once 'helpers/Formate.php';?>

<?php
$pd = new Customer();
$fm = new Format();


?>

<?php
if (isset($_GET['delUser'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delUser']);
	$delUser = $pd->delUserById($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Index_userlist.css">
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

<div class="block">               
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role">
                                        <?php
                                            $selected = $_GET["role"];
                                            $options = array("All", "Admin", "User");
                                            foreach ($options as $option) {
                                                if ($option == $selected) {
                                                    echo "<option selected='selected' value='$option'>$option</option>";
                                                } else {
                                                    echo "<option value='$option'>$option</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
                if (isset($delUser)) {
                    echo $delUser;
                }
            ?> 

            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['role'])){
                            $role = $_GET['role'];
                            if($role == "All"){
                                $getPd = $pd->getAllCustomer();
                                if ($getPd) {
                                    $i = 0;
                                    while ($result = $getPd->fetch_assoc()) {
                                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['first_name'];?></td>
                        <td><?php echo $result['last_name'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $result['role'];?></td>
                        <td class="table-actions">
                            <a href="manageUser_Edit.php?userid=<?php echo $result['id'];?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure to delete!')" href="?delUser=<?php echo $result['id'];?>">Delete</a>
                        </td>
                    </tr>
                    <?php }} }
                    elseif($role == "Admin"){
                        $getPd = $pd->getAllSystemAdmin();
                        if ($getPd) {
                            $i = 0;
                            while ($result = $getPd->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['first_name'];?></td>
                        <td><?php echo $result['last_name'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $result['role'];?></td>
                        <td class="table-actions">
                            <a href="manageUser_Edit.php?userid=<?php echo $result['id'];?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure to delete!')" href="?delUser=<?php echo $result['id'];?>">Delete</a>
                        </td>
                    </tr>
                    <?php }}
                    }
                    elseif($role == "User"){
                        $getPd = $pd->getAllCustomerRole();
                        if ($getPd) {
                            $i = 0;
                            while ($result = $getPd->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['first_name'];?></td>
                        <td><?php echo $result['last_name'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $result['role'];?></td>
                        <td class="table-actions">
                            <a href="manageUser_Edit.php?userid=<?php echo $result['id'];?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure to delete!')" href="?delUser=<?php echo $result['id'];?>">Delete</a>
                        </td>
                    </tr>
                    <?php }}
                    }
                }
                ?>
                </tbody>
            </table>
</div>

</body>
</html>


<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>

<?php include 'inc/scripts.php'; ?>


