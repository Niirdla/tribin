<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Formate.php');

?>


<?php

class Customer{
	
private $db;
private $fm;


	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}
// public function customerRegistration($data){
	
// $con = mysqli_connect('localhost', 'root', '', 'db_shop');	
// $errors = array();	

// $first_name = mysqli_real_escape_string($this->db->link, $data['first_name']);
// $last_name = mysqli_real_escape_string($this->db->link, $data['last_name']);
// $address = mysqli_real_escape_string($this->db->link, $data['address']);
// $city = mysqli_real_escape_string($this->db->link, $data['city']);
// $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
// $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
// $email = mysqli_real_escape_string($this->db->link, $data['email']);
// $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
// $cpass = mysqli_real_escape_string($this->db->link, md5($data['cpass']));

// if ($first_name == "" || $last_name == "" ||$address == "" || $city == "" || $zip == "" || $phone == "" || $email == "" || $pass == ""|| $cpass == "") {
	
// 	$msg = "<span class='error'style = 'color:red;'>Fields must not be empty !</span>";
// 	return $msg;
// }

//   $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
//   $mailchk = $this->db->select($mailquery);
//   if ($mailchk != false) {
//   	$msg = "<span class='error'style = 'color:red;'>Email already exist !</span>";
// 	return $msg;
//   }
//   elseif($pass !== $cpass){

// 	echo "<p style = 'color:red;'>Confirm password not match </p>";
//   }else{
// 	$code = rand(999999, 111111);
//     $status = "notverified";
// 	$role = "Customer";

// 	$query = "INSERT INTO tbl_customer(first_name,last_name,address,city,zip,phone,email,pass,code,status,role) VALUES('$first_name','$last_name','$address','$city','$zip','$phone','$email','$pass','$code','$status','$role')";
// 	$data_check = mysqli_query($con, $query);
// 	if($data_check){
// 		$subject = "Email Verification Code";
//         $message = "Your verification code is $code";
//         $sender = "From: amberspirit16@gmail.com";
// 		if(mail($email, $subject, $message, $sender)){
// 			$info = "We've sent a verification code to your email - $email";
// 			$_SESSION['info'] = $info;
// 			$_SESSION['email'] = $email;
// 			$_SESSION['pass'] = $pass;
// 			header('location: user-otp.php');
// 			exit();
// 		}else{
// 			$errors['otp-error'] = "Failed while sending code!";
// 		}
// 	}else{
// 		$errors['db-error'] = "Failed while inserting data into database!";
// 	}
// 	$inserted_row = $this->db->insert($query);
// 	if ($inserted_row) {
		
// 	$msg = "<span class='success'style = 'color:green;'>Customer Data inserted Successfully.</span>";
// 		return $msg;
	
		
// 	} else{
// 		$msg = "<span class='error'style = 'color:red;'>Customer Data Not inserted.</span>";
// 		return $msg;
// }
//   }
  
  
// }


public function AdmincustomerRegistration($data){

	$first_name = mysqli_real_escape_string($this->db->link, $data['first_name']);
	$last_name = mysqli_real_escape_string($this->db->link, $data['last_name']);
	$email = mysqli_real_escape_string($this->db->link, $data['email']);
	$pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
	$role = mysqli_real_escape_string($this->db->link, $data['role']);
	
	if ($first_name == "" ||$last_name == "" || $email == "" || $pass == ""|| $role == "") {
		
		$msg = "<span class='error'style = 'color:red;'>Fields must not be empty !</span>";
		return $msg;
	}
	
	  $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
	  $mailchk = $this->db->select($mailquery);
	  if ($mailchk != false) {
		  $msg = "<span class='error' style = 'color:red;'>Email already exist !</span>";
		return $msg;
	  }else{
	
	
		   $query = "INSERT INTO tbl_user(first_name,last_name,email,pass,role) VALUES('$first_name','$last_name','$email','$pass','$role')";
	
		 $inserted_row = $this->db->insert($query);
				if ($inserted_row) {
					$msg = "<span class='success'style = 'color:green;'>Customer Data inserted Successfully.</span>";
					return $msg;
				} else{
					$msg = "<span class='error'style = 'color:red;'>Customer Data Not inserted.</span>";
					return $msg;
			}
	  }
	}

// public function resetPassword($data){
// 	$con = mysqli_connect('localhost', 'root', '', 'db_shop');	
// 	$errors = array();	
// 	//if user click change password button

//     if(isset($_POST['change-password'])){
//         $_SESSION['info'] = "";
//         $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
// 		$cpass = mysqli_real_escape_string($this->db->link, md5($data['cpass']));

// 		if($pass !== $cpass){

// 			echo "<p style = 'color:red;'>Confirm password not match</p>";
// 		  }else{

       
//             $code = 0;
//             $email = $_SESSION['email']; //getting this email using session
//             $update_pass = "UPDATE tbl_customer SET code = $code, pass = '$pass' WHERE email = '$email'";
//             $run_query = mysqli_query($con, $update_pass);
//             if($run_query){
//                 $info = "Your password changed. Now you can login with your new password.";
//                 $_SESSION['info'] = $info;
//                 header('Location: password-changed.php');
//             }else{
//                 $errors['db-error'] = "Failed to change your password!";
//             }
//         }
// 	}
	
// }
public function getAllCustomer(){

	$query = "SELECT u.*
	FROM tbl_user as u
	ORDER BY u.id DESC";
	
	/*
	$query = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
	FROM tbl_product
	
	INNER JOIN tbl_category
	ON tbl_product.catId = tbl_category.catId
	
	INNER JOIN tbl_brand
	ON tbl_product.brandId = tbl_brand.brandId
	ORDER BY tbl_product.productId DESC";
	*/
	$result = $this->db->select($query);
	return $result;
	}

	public function getAllCustomerRole(){

		$query = "SELECT u.*
		FROM tbl_user as u WHERE u.role = 'User'
		ORDER BY u.id DESC";
		
		/*
		$query = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
		FROM tbl_product
		
		INNER JOIN tbl_category
		ON tbl_product.catId = tbl_category.catId
		
		INNER JOIN tbl_brand
		ON tbl_product.brandId = tbl_brand.brandId
		ORDER BY tbl_product.productId DESC";
		*/
		$result = $this->db->select($query);
		return $result;
		}
		public function getAllSystemAdmin(){

			$query = "SELECT u.*
			FROM tbl_user as u WHERE u.role = 'Admin'
			ORDER BY u.id DESC";
			
			/*
			$query = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
			FROM tbl_product
			
			INNER JOIN tbl_category
			ON tbl_product.catId = tbl_category.catId
			
			INNER JOIN tbl_brand
			ON tbl_product.brandId = tbl_brand.brandId
			ORDER BY tbl_product.productId DESC";
			*/
			$result = $this->db->select($query);
			return $result;
			}
// 			public function getAllAdminVendor(){

// 				$query = "SELECT u.*
// 				FROM tbl_customer as u WHERE u.role = 'Vendor'
// 				ORDER BY u.id DESC";
				
// 				/*
// 				$query = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
// 				FROM tbl_product
				
// 				INNER JOIN tbl_category
// 				ON tbl_product.catId = tbl_category.catId
				
// 				INNER JOIN tbl_brand
// 				ON tbl_product.brandId = tbl_brand.brandId
// 				ORDER BY tbl_product.productId DESC";
// 				*/
// 				$result = $this->db->select($query);
// 				return $result;
// 				}

public function userLogin($data){

$email = mysqli_real_escape_string($this->db->link, $data['email']);
$pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
if (empty($email) || empty($pass)) {
$msg = "<span class='error'>Fields must not be empty !</span>";
	return $msg;
}
$query = "SELECT * FROM tbl_user WHERE email = '$email' AND pass = '$pass'";
$result = $this->db->select($query);

if ($result) {
    $value = $result->fetch_assoc();
	$role = $value['role'];
	if ($role === 'Admin') {
		Session::set("Adminlogin", true);
		Session::set("admId", $value['id']);
		header("Location:index_admin.php");
        exit();
	}elseif ($role === 'User') {
		Session::set("usrlogin", true);
        Session::set("usrId", $value['id']);
        Session::set("cmrName", $value['first_name']);
		header("Location:index_user.php");
        exit();
	}
}
else{
$msg = "<span class='error' style='color:red;'>Email or Password not matched !</span>";
return $msg;
}
}

public function getCustomerData($id){
	$query = "SELECT * FROM tbl_user WHERE id = '$id'";
		$result = $this->db->select($query);
		return $result;
}


public function customerUpdate($data,$file,$id){

	$first_name = $this->fm->validation($data['first_name']);
	$last_name = $this->fm->validation($data['last_name']);
	$email = $this->fm->validation($data['email']);
	$role = $this->fm->validation($data['role']);
	
	$first_name = mysqli_real_escape_string($this->db->link, $data['first_name']);
	$last_name = mysqli_real_escape_string($this->db->link, $data['last_name']);
	$email = mysqli_real_escape_string($this->db->link, $data['email']);
	$role = mysqli_real_escape_string($this->db->link, $data['role']);
	
	if ($first_name == "" || $last_name == "" || $email == ""|| $role == "") {
		
		$msg = "<span class='error'>Fields must not be empty !</span>";
		return $msg;
	}else{
	
	
		
	
		$query = "UPDATE tbl_user
	
		SET
		first_name = '$first_name',
		last_name = '$last_name',
		email = '$email',
		role = '$role'
	
		WHERE id = '$id'";
	
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			$msg = "<span class='success' style = 'color:green;'>Customer Data Updated Successfully.</span>";
					return $msg;
		} else{
				$msg = "<span class='error'>Customer Data Not Updated !</span>";
					return $msg;
		}
	  }
	}

public function delUserById($id){

	$delquery = "DELETE FROM tbl_user where id = '$id'";
	$deldata = $this->db->delete($delquery);
		if ($deldata) {
			$msg = "<span class='success' style = 'color:green;'>Product Deleted Successfully.</span>";
					return $msg;
		}else{
	$msg = "<span class='error'>Product Not Deleted !</span>";
					return $msg;
	
		}
	
	}
}


?>