<?php require_once "db/config.php"; 
extract($_POST);
$plan_id = mysqli_real_escape_string($conn,$_POST['plan_id']);
$premium_plans = mysqli_real_escape_string($conn,$_POST['premium_months']);
$premium_payments = mysqli_real_escape_string($conn,$_POST['payment_types']);
$curr_date = date('Y-m-d');
$expire_date = date('Y-m-d', strtotime('+'.$premium_plans.' months'));
if($premium_plans == ''){
	$error_msg['main_error'] = "Must choose a premium plan";
}else{
   $insertQuery = mysqli_query($conn,"UPDATE `company_reg` SET prime_id = '".$premium_plans."',payment_mode = '".$premium_payments."',`prime_start_date` = '".$curr_date."',`prime_end_date` = '".$expire_date."'  WHERE id = '".$plan_id."' ");
  if($insertQuery){
  	$error_msg['no_error'] = "Prime membership added Successfully";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
}
echo json_encode($error_msg);

?>