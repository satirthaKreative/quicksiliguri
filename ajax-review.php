<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
$list_id = mysqli_real_escape_string($conn,$_POST['property_id']);
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
$user_id = mysqli_real_escape_string($conn,$_POST['customer_id']);
// ajax insert
$user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
$user_mail = mysqli_real_escape_string($conn,$_POST['user_email']);
$user_subject = mysqli_real_escape_string($conn,$_POST['user_subject']);
$user_review = mysqli_real_escape_string($conn,$_POST['user_reviews']);
$user_rating = mysqli_real_escape_string($conn,$_POST['user_rating']);

if($user_name == ''){ 
  $error_msg['main_error'] = "Enter your user name";
} else if($user_mail == ''){
	$error_msg['main_error'] = "Enter your vaild e-mail address";
} else if($user_rating == ''){
	$error_msg['main_error'] = "Choose the rating";
} else if($user_review == ''){
  $error_msg['main_error'] = "Submit a review?";
} else{
  if($user_id !=''){
    $insertQuery = mysqli_query($conn,"INSERT INTO `customer_reviews` SET `property_id` = '".$list_id."' , `company_id` = '".$company_id."' , `customer_id` = '".$user_id."' , `customer_name` = '".$user_name."' , `customer_email` = '".$user_mail."' , `customer_rating` = '".$user_rating."' , `customer_subject` = '".$user_subject."' , `customer_review` = '".$user_review."'    ");
  }else{
    $insertQuery = mysqli_query($conn,"INSERT INTO `customer_reviews` SET `property_id` = '".$list_id."' , `company_id` = '".$company_id."' , `customer_name` = '".$user_name."' , `customer_email` = '".$user_mail."' , `customer_rating` = '".$user_rating."' , `customer_subject` = '".$user_subject."' , `customer_review` = '".$user_review."'     ");
  }
  if($insertQuery>0){
  	$error_msg['no_error'] = "Thank you for rating us";
  }else{
  	$error_msg['main_error'] = "Server Issue! Try Again Later ";
  }
}
echo json_encode($error_msg);

?>