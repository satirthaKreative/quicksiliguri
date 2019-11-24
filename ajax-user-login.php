<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
$user_mail = mysqli_real_escape_string($conn,$_POST['user_email']);
$user_pass = mysqli_real_escape_string($conn,$_POST['user_pass']);
if($user_mail == ''){
	$error_msg['main_error'] = "Enter your vaild e-mail address";
} else if($user_pass == ''){
	$error_msg['main_error'] = "Enter password";
} else{
    $insertQuery = mysqli_query($conn,"SELECT * FROM `customer_tbl` WHERE `user_pass` = '".md5($user_pass)."' AND `user_email` = '".$user_mail."' ");
  if(mysqli_num_rows($insertQuery)>0){
    $fetch_details = mysqli_fetch_array($insertQuery);
    $_SESSION['front_user_id'] = $fetch_details['id'];
  	$error_msg['no_error'] = "Login Successfully!";
  }else{
  	$error_msg['main_error'] = "Username / Password Invalid";
  }
}
echo json_encode($error_msg);

?>