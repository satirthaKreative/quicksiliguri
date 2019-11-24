<?php  require_once "../quick-back/db/config.php"; 
extract($_POST);

$insertQuery = mysqli_query($conn,"SELECT * FROM `customer_enquiry` WHERE id = '".$_POST['data']."' ");
$fetchQuery = mysqli_fetch_array($insertQuery);
  if(mysqli_num_rows($insertQuery)>0){
  	$error_msg['no_error'] = $fetchQuery['customer_enquiry']."  <a href='javascript:;'  onclick='view_less(".$fetchQuery[0].",".$_POST['countid'].")'><i class='fa fa-minus' style='color:red;'></a>";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>