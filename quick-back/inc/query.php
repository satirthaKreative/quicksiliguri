<?php 

	// admin-profile
	if(isset($_SESSION['login_id'])){
		$select_admin_profile = mysqli_query($conn,"SELECT * FROM `admin` WHERE id = '".$_SESSION['login_id']."' ");
		$fetch_admin_profile = mysqli_fetch_array($select_admin_profile);
	}
	//employee login
	if(isset($_SESSION['emp_id'])){
		$select_admin_profile = mysqli_query($conn,"SELECT * FROM `admin` WHERE  id = '".$_SESSION['emp_id']."' ");
		$fetch_admin_profile = mysqli_fetch_array($select_admin_profile);
	}
	// admin category
	$select_admin_category = mysqli_query($conn,"SELECT * FROM `category`");

	// admin location
	$select_location = mysqli_query($conn,"SELECT * FROM `location` ");

	// admin prime
	$select_admin_prime = mysqli_query($conn,"SELECT * FROM `prime_listing` ORDER BY prime_months ASC ");

	// admin company list
	$select_company_list = mysqli_query($conn,"SELECT * FROM `company_reg` ");

	//prime member
	$select_prime = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE prime_id <> 0 ");

	// View Icon

	$select_icon = mysqli_query($conn,"SELECT * FROM `category_icon` ");
	// listing
	$select_listing_final = mysqli_query($conn,"SELECT * FROM `listing_details` ");

?>