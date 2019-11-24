<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
    $insertQuery = mysqli_query($conn,"UPDATE `location` SET location_name = '".$_POST['location']."' WHERE id = '".$_POST['location_id']."' ");
  if($insertQuery){
  	$error_msg['no_error'] = "Location updated Successfully";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>