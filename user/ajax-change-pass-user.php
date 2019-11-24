<?php  require_once "../quick-back/db/config.php"; 

//change pass ajax

extract($_POST);
$selectPass = mysqli_query($conn,"SELECT * FROM `customer_tbl` WHERE id = '".$_POST['profile_id']."' AND user_org_pass = '".$_POST['c_pass']."' ");
if(mysqli_num_rows($selectPass) == 0){
	$error_msg['main_error'] = "Enter your valid current password";
}else if($_POST['n_pass'] != $_POST['cn_pass']){
	$error_msg['main_error'] = "Confirm password doesn't matched with new password";
}else{
  $insertQuery = mysqli_query($conn,"UPDATE `customer_tbl` SET user_org_pass = '".$_POST['n_pass']."', user_pass = '".md5($_POST['n_pass'])."' WHERE id = '".$_POST['profile_id']."' ");
  if($insertQuery){
  	$error_msg['no_error'] = "Password Successfully Changed";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
}
echo json_encode($error_msg);

?>