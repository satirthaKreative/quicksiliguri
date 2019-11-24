<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
$i = 0;
  foreach($_POST['prime_months'] as $p_months){
  	$pay = $_POST['prime_pay'][$i];
    $insertQuery = mysqli_query($conn,"INSERT INTO `prime_listing` SET `prime_months` = '".$p_months."', `prime_pay` = '".$pay."'  ");
    $i++;
  }
  if($insertQuery){
  	$error_msg['no_error'] = "Prime Statement Added Successfully";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>