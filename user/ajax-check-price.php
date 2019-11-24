<?php  
// config file
require_once "../quick-back/db/config.php"; 
extract($_POST);
$search_months = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE prime_months = '".$_POST['choose_listing_type']."' AND status = 1 ");
$fetch_months = mysqli_fetch_array($search_months);
if(mysqli_num_rows($search_months)>0){
	$errmsg['no_error'] = $fetch_months['prime_pay'];
} else{
	$errmsg['main_error'] = 'Server problem! Try again';
}
echo json_encode($errmsg);

?>