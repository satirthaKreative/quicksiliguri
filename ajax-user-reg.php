<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
$user_mail = mysqli_real_escape_string($conn,$_POST['usermail']);
$user_pass = mysqli_real_escape_string($conn,$_POST['password']);
$user_cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);
$select_uniq_mail = mysqli_query($conn,"SELECT * FROM `customer_tbl` WHERE `user_email` = '".$user_mail."' ");
if($user_mail == ''){
	$error_msg['main_error'] = "Enter your vaild e-mail address";
} else if(mysqli_num_rows($select_uniq_mail)>0){ 
	$error_msg['main_error'] = "You are already registered";
} else if($user_pass == ''){
	$error_msg['main_error'] = "Enter password";
} else if(strlen($user_pass) < 6){
	$error_msg['main_error'] = "Enter atleast 6 digit password";
} else  if($user_pass != $user_cpass){ 
	$error_msg['main_error'] = "Both password didn't matched";
}else{
    $insertQuery = mysqli_query($conn,"INSERT INTO `customer_tbl` SET `user_pass` = '".$user_pass."' , `user_email` = '".$user_mail."' ");
  if($insertQuery>0){
  	$error_msg['no_error'] = "Registered Successfully!";
  }else{
  	$error_msg['main_error'] = "Try again! Something went wrong";
  }
}
echo json_encode($error_msg);

?>