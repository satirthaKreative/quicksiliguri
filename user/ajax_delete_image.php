<?php  require_once "../quick-back/db/config.php"; 

//change pass ajax

extract($_POST);

  $delQuery = mysqli_query($conn,"DELETE FROM `property_images` WHERE id = '".$_POST['delId']."' ");
  if($delQuery){
  	$error_msg['no_error'] = "Successfully Deleted";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>