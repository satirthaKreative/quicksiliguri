<?php  
// connection db
require_once "db/config.php";
// extract
extract($_POST);
// queries
$updateQuery = mysqli_query($conn,"UPDATE `company_reg` SET company_name = '".$_POST['business_name']."', contact_number = '".$_POST['business_contact']."' WHERE id = '".$_POST['business_id']."' ");
if($updateQuery){
	$no_error['no_error'] = "Company listed successfully";
}else{
	$no_error['main_error'] = "Something went wrong! Try again";
}
echo json_encode($no_error);
?>