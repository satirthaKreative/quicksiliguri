<?php require_once "db/config.php"; 
extract($_POST);
 
$update_status = mysqli_query($conn,"UPDATE `advertize` SET status =  '".$_POST['activity']."' WHERE id = '".$_POST['loc_id']."' ");
if($update_status){
	$error_msg['no_error'] = "Status changed successfully"; 
}
echo json_encode($error_msg);

?>