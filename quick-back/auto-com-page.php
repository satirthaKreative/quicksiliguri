<?php require_once "db/config.php"; 
extract($_POST);
// category view
if(isset($_POST['auto_fill_div'])){
if($_POST['auto_fill_div']!=''){
  $select_auto_cate = mysqli_query($conn,"SELECT * FROM `category` WHERE category_name like '%".$_POST['auto_fill_div']."%' ");
  $errmsg['no_error'] = '';
  if(mysqli_num_rows($select_auto_cate)>0){
  while($fetch_auto_cate = mysqli_fetch_array($select_auto_cate)){
    $errmsg['no_error'] .= '<input type="button" name="auto_fill" id="auto_fill" class="btn btn-primary form-control" onclick="data_choose(this);" value="'.$fetch_auto_cate['category_name'].'">';
  }
  }else{
    $errmsg['main_error'] = '';
  }
}else{
	$errmsg['main_error'] ='';
}


  echo json_encode($errmsg);
}
// location
if(isset($_POST['auto_fill_div1'])){
if($_POST['auto_fill_div1']!=''){
  $select_auto_cate1 = mysqli_query($conn,"SELECT * FROM `location` WHERE location_name like '%".$_POST['auto_fill_div1']."%' ");
  $errmsg['no_error'] = '';
  if(mysqli_num_rows($select_auto_cate1)>0){
  while($fetch_auto_cate1 = mysqli_fetch_array($select_auto_cate1)){
    $errmsg['no_error'] .= '<input type="button" name="auto_fill" id="auto_fill" class="btn btn-primary form-control" onclick="data_choose(this);" value="'.$fetch_auto_cate1['location_name'].'">';
  }
  }else{
    $errmsg['main_error'] = '';
  }
}else{
	$errmsg['main_error'] ='';
}


  echo json_encode($errmsg);
}
// enquiry
if(isset($_POST['auto_fill_div2'])){
if($_POST['auto_fill_div2']!=''){
  // echo "SELECT * FROM `customer_enquiry` INNER JOIN `listing_details` ON company_enquiry.property_id = listing_details.id WHERE property_name like '%".$_POST['auto_fill_div2']."%' ";
  $select_auto_cate2 = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE property_name like '%".$_POST['auto_fill_div2']."%' ");
  $errmsg['no_error'] = '';
  if(mysqli_num_rows($select_auto_cate2)>0){
  while($fetch_auto_cate2 = mysqli_fetch_array($select_auto_cate2)){
    $errmsg['no_error'] .= '<input type="button" name="auto_fill" id="auto_fill" class="btn btn-primary form-control" onclick="data_choose(this);" value="'.$fetch_auto_cate2['property_name'].'">';
  }
  }else{
    $errmsg['main_error'] = '';
  }
}else{
  $errmsg['main_error'] ='';
}


  echo json_encode($errmsg);
}
?>