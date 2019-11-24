<?php 
require_once "quick-back/db/config.php";
// extract post value
extract($_POST);
// check details of login
$business_name = mysqli_real_escape_string($conn,$_POST['comp_name']);
$business_no = mysqli_real_escape_string($conn,$_POST['contact_no']);
// fetch data
$selectQuery = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE company_name = '".$business_name."' AND contact_number = '".$business_no."' AND admin_approval = 1 ");
$countDetails = mysqli_num_rows($selectQuery);
if($countDetails>0){
	$error_msg['main_error'] = 1;
}else{
	$error_msg['no_error'] = 0;
}
echo json_encode($error_msg);
?>