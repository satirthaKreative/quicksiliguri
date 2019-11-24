<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
if($_POST['com_id'] == ''){
	$error_msg['validation'] = "Enter a valid company name";
}else if(strlen($_POST['contact_no']) != 10){
	$error_msg['validation'] = "Enter 10 digit valid phone number";
}else{
    $insertQuery = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE company_name = '".$_POST['com_id']."' AND (contact_number = '".$_POST['contact_no']."' OR alt_contact_no = '".$_POST['contact_no']."') ");
  if(mysqli_num_rows($insertQuery)>0){
  	$error_msg['no_error'] = "Already registered ";
  }else{
  	$error_msg['main_error'] = "Something Went Wrong! Try again later";
  }
}
echo json_encode($error_msg);

?>