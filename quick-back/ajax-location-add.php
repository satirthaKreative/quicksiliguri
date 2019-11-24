<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
  foreach($_POST['location'] as $location){
    $insertQuery = mysqli_query($conn,"INSERT INTO `location` SET location_name = '".$location."' ");
  }
  if($insertQuery){
  	$error_msg['no_error'] = "Location Added Successfully";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>