<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
    $insertQuery = mysqli_query($conn,"UPDATE `prime_listing` SET prime_months = '".$_POST['prime_months']."' , prime_pay = '".$_POST['prime_pay']."' WHERE id = '".$_POST['prime_id']."' ");
  if($insertQuery){
  	$error_msg['no_error'] = "Prime plans updated Successfully";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>