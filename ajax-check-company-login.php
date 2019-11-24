<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
    $insertQuery = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE company_name = '".$_POST['com_id']."'  ");
  if(mysqli_num_rows($insertQuery)>0){
  	$mysqli_fetch = mysqli_fetch_array($insertQuery);
  	if($mysqli_fetch['status'] == 0){
  		$error_msg['main_error'] = "Admin blocked your account";
  	}else{
  		$error_msg['no_error'] = "<i class='fa fa-check'></i>";
  	}
  }else{
  	$error_msg['main_error'] = "Not registered yet";
  }
echo json_encode($error_msg);

?>