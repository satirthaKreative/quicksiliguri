<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
$u_pass = $_POST['u_pass'];
$cu_pass = $_POST['cu_pass'];
if($u_pass == ''){
	$error_msg['main_error'] = "Enter a valid password";
}else if($cu_pass == ''){
 	$error_msg['main_error'] = "Enter a valid confirm  password";
}else if($u_pass != $cu_pass){
	$error_msg['main_error'] = "Both password doesn't matched";
}else if($u_pass == $cu_pass){
	if(isset($_SESSION['login_id'])){
		$insertQuery = "UPDATE `admin` SET u_pass = '".md5($u_pass)."', u_org_pass = '".$u_pass."' WHERE id = '".$_SESSION['login_id']."' ";
	}else if(isset($_SESSION['emp_id'])){
		$insertQuery = "UPDATE `admin` SET u_pass = '".md5($u_pass)."', u_org_pass = '".$u_pass."' WHERE id = '".$_SESSION['emp_id']."' ";
	}
	$updateQuery = mysqli_query($conn,$insertQuery);
	if($updateQuery){
		$error_msg['no_error'] = "Password Changed Successfully";
	}else{
		$error_msg['main_error'] = "Password doesn't changed";
	}

}else{
	$error_msg['main_error'] = "Error Invalid";
}

echo json_encode($error_msg);

?>