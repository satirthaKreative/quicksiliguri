<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
if($_POST['activity']!='' && $_POST['loc_id']!=''){
    $insertQuery = mysqli_query($conn,"UPDATE `prime_listing` SET status = '".$_POST['activity']."' WHERE id = '".$_POST['loc_id']."' ");
  if($insertQuery){
  	$error_msg['no_error'] = "Prime plan Status Changed";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
}else{
	$error_msg['main_error'] = "Something Went Wrong! Try again later";
}
echo json_encode($error_msg);

?>