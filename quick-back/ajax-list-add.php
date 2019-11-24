<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
$i = 0;
  foreach($_POST['business_name'] as $p_months){
  	$pay = $_POST['business_contact'][$i];
    $insertQuery = mysqli_query($conn,"INSERT INTO `company_reg` SET `company_name` = '".$p_months."', `contact_number` = '".$pay."' ");
    $i++;
  }
  if($insertQuery){
  	$error_msg['no_error'] = "Business Added Successfully";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>