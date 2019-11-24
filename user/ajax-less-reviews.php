<?php  require_once "../quick-back/db/config.php"; 
extract($_POST);

$insertQuery = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE id = '".$_POST['data']."' ");
$fetchQuery = mysqli_fetch_array($insertQuery);
  if(mysqli_num_rows($insertQuery)>0){
  	if(strlen($fetchQuery['customer_reviews'])>100){
  	$error_msg['no_error'] = substr($fetchQuery['customer_reviews'],0,100)."...  <a href='javascript:;' onclick='view_more(".$fetchQuery[0].",".$_POST['countid'].")'><i class='fa fa-plus' style='color:blue;'></a>";
  	}
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
echo json_encode($error_msg);

?>