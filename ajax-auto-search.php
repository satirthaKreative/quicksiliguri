<?php require_once "quick-back/db/config.php";
extract($_POST);
$q_name = mysqli_real_escape_string($conn,$_POST['q_name']);
if($_POST['q_name'] !=''){
    $insertQuery = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE  property_name like '%".$_POST['q_name']."%'  ");
    $error_msg['no_error'] ='';
  if(mysqli_num_rows($insertQuery)>0){
  	while($fetch_p_name = mysqli_fetch_array($insertQuery)){
      $error_msg['no_error'] .='<input type="button" class="auto_com_box" onclick="q_click(this);" value="'.$fetch_p_name['property_name'].'">';
    }
  }else{
  	$error_msg['main_error'] = 1;
  }
}else{
  $error_msg['main_error'] = 1;
}
echo json_encode($error_msg);

?>