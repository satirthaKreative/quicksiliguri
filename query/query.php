<?php  
// select all property list
$selectAllProperty = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` WHERE listing_details.user_id = company_reg.id ORDER BY company_reg.prime_id DESC ");
// select all category
$selectAllCategory = mysqli_query($conn,"SELECT * FROM `category` ");
//customer details if logged-in
if(isset($_SESSION['front_user_id'])){
	$select_logged_customer = mysqli_query($conn,"SELECT * FROM `customer_tbl` WHERE id = '".$_SESSION['front_user_id']."' ");
	$fetch_logged_customer = mysqli_fetch_array($select_logged_customer);
}
// select all locations
$select_location = mysqli_query($conn,"SELECT * FROM `location` ");
// select all category
$select_category = mysqli_query($conn,"SELECT * FROM `category` ");

?>