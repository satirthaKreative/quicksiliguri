<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
$list_id = mysqli_real_escape_string($conn,$_POST['listing_id']);
// select listing
$select_list = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE id = '".$list_id."'  ");
$fetch_list = mysqli_fetch_array($select_list);
// select company
$select_company = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE id = '".$fetch_list['user_id']."' ");
$fetch_company = mysqli_fetch_array($select_company);
// retrive premium 
$user_premium = $fetch_company['prime_id'];
//comapny identity
$company_id = $fetch_company['id'];
//user identity
$user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
// ajax insert
$user_name = mysqli_real_escape_string($conn,$_POST['name']);
$user_mail = $_POST['email'];
$user_phone = mysqli_real_escape_string($conn,$_POST['phone']);
$user_enquiry = mysqli_real_escape_string($conn,$_POST['comments']);
// if($user_name == ''){ 
//   $error_msg['main_error'] = "Enter your user name";
// }
if($user_mail == ''){
	$error_msg['main_error'] = "Enter your vaild e-mail address";
} else if($user_phone == ''){
	$error_msg['main_error'] = "Enter your contact number";
} else if(strlen($user_phone)<10){
  $error_msg['main_error'] = "Enter your valid 10 digit contact number";
} else if($user_enquiry == ''){
  $error_msg['main_error'] = "Ask your query ?";
} else{
  if($user_id !=''){
    $insertQuery = mysqli_query($conn,"INSERT INTO `customer_enquiry` SET `company_id` ='".$company_id."' , `customer_id` = '".$user_id."' , `prime_status` ='".$user_premium."' , `customer_enquiry` = '".$user_enquiry."', `customer_name` = '".$user_name."' , `customer_email` = '".$user_mail."' , `customer_contact` = '".$user_phone."', `property_id` = '".$list_id."'   ");
  }else{
    $insertQuery = mysqli_query($conn,"INSERT INTO `customer_enquiry` SET `company_id` ='".$company_id."' , `prime_status` ='".$user_premium."' , `customer_enquiry` = '".$user_enquiry."', `customer_name` = '".$user_name."' , `customer_email` = '".$user_mail."' , `customer_contact` = '".$user_phone."', `property_id` = '".$list_id."'   ");
  }
  if($insertQuery>0){
  	$error_msg['no_error'] = "Your enquiry successfully send to owner";
  }else{
  	$error_msg['main_error'] = "Server Issue! Try Again Later ";
  }
}
echo json_encode($error_msg);

?>