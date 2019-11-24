<?php  
// connection db
require_once "db/config.php";
// extract
extract($_POST);
// queries
$updateQuery = mysqli_query($conn,"UPDATE `company_reg` SET admin_approval = '".$_POST['activity']."' WHERE id = '".$_POST['loc_id']."' ");
if($updateQuery){
	$no_error['no_error'] = "Company listed successfully";
}else{
	$no_error['main_error'] = "Something went wrong! Try again";
}
echo json_encode($no_error);
?>