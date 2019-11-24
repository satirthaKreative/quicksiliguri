<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Quick Siliguri</title>
<?php include'../style.php';?>
<body>

<div id="main_wrapper">
<?php include'header.php';?>
<?php  
// save change to prime 
if(isset($_POST['company_member_prime'])){
	if($_POST['choose_listing_type'] != 0){
		if($_POST['choose_listing_type'] != 0){
			$today_prime = date('Y-m-d');
			$effectiveDate = date('Y-m-d', strtotime("+".$_POST['choose_listing_type']." months", strtotime($today_prime)));
		}else{
			$today_prime = null;
			$effectiveDate = null;
		}
		$update_prime_membership = mysqli_query($conn,"UPDATE `company_reg` SET prime_id = '".$_POST['choose_listing_type']."', prime_start_date = '".$today_prime."', payment_mode = '".$_POST['mode_of_payment']."' , prime_end_date = '".$effectiveDate."' WHERE id = '".$_SESSION['company_session_id']."' ");
	}
	if($_POST['choose_listing_type1'] != 0){
		if($_POST['choose_listing_type1'] != 0){
			$today_prime = date('Y-m-d');
			$effectiveDate = date('Y-m-d', strtotime("+".$_POST['choose_listing_type1']." months", strtotime($today_prime)));
		}else{
			$today_prime = null;
			$effectiveDate = null;
		}
		$update_prime_membership = mysqli_query($conn,"UPDATE `company_reg` SET prime_id = '".$_POST['choose_listing_type1']."', prime_start_date = '".$today_prime."', payment_mode = '".$_POST['mode_of_payment']."' , prime_end_date = '".$effectiveDate."' WHERE id = '".$_SESSION['company_session_id']."' ");
	}
	if($_POST['choose_listing_type'] == 0 && $_POST['choose_listing_type1'] == 0){
		$today_prime = null;
		$effectiveDate = null;
		$update_prime_membership = mysqli_query($conn,"UPDATE `company_reg` SET prime_id = '".$_POST['choose_listing_type']."', prime_start_date = '".$today_prime."', payment_mode = '".$_POST['mode_of_payment']."' , prime_end_date = '".$effectiveDate."' WHERE id = '".$_SESSION['company_session_id']."' ");
	}
	
	if($update_prime_membership){
		$prime_msg = "<p class='text-success' style='color:green;'>Delete the image successfully</p>";
	}else{
		$prime_msg = "<p class='text-success' style='color:green;'>Delete the image successfully</p>";
	}
}
// delete others images
if(isset($_GET['del_o_id'])){
	$del_o_id = mysqli_query($conn,"DELETE FROM property_images WHERE id = '".$_GET['del_o_id']."' ");
	if($del_o_id){
		$msg = "<p class='text-success' style='color:green;'>Delete the image successfully</p>";
	}else{
		$msg = "<p class='text-danger' style='color:red;'>Something wrong ! Try again later</p>";
	}
}
// check add or edit

$select_add_edit = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE user_id = '".$_SESSION['company_session_id']."' ");
if(mysqli_num_rows($select_add_edit)>0){
	$update = 1;
	$fetch_add_edit = mysqli_fetch_array($select_add_edit);
}else{
	$update = 0;
}
?>
<?php
	if(isset($_SESSION['company_session_id'])){
		$selectPrimeSessionCheck = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE id = '".$_SESSION['company_session_id']."' ");
		$fetchPrimeSessionCheck = mysqli_fetch_array($selectPrimeSessionCheck);
		if($fetchPrimeSessionCheck['prime_id'] != 0){
 		if(strtotime(date('Y-m-d'))>strtotime($fetchPrimeSessionCheck['prime_end_date'])){ 

 			$updateSession = mysqli_query($conn,"UPDATE `company_reg` SET prime_id = 0 WHERE id = '".$_SESSION['company_session_id']."'  ");
 			if($updateSession){
 				echo "Youe premium membership expired";
 			}
 		 } 
	} 
  } 
?>

<?php 
if($update == 0){
if(isset($_POST['company_save'])){
	$updateQuery_reg = mysqli_query($conn,"UPDATE `company_reg` SET contact_person = '".$_POST['contact_person']."', contact_mail = '".$_POST['contact_mail']."', contact_number = '".$_POST['contact_number']."',alt_contact_no = '".$_POST['company_alt_contact']."' WHERE id = '".$_SESSION['company_session_id']."' ");
	if($_FILES['user_image']['size']!=0){
	extract($_POST);
	$filemain = $_FILES['user_image']['name'];
	$valid_ext = ['png','jpeg','jpg'];
	$location = "uploads/property/".$filemain;
	$file_extension = pathinfo($location, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);

	// Check extension
	if(in_array($file_extension,$valid_ext)){

	  // Compress Image
	  if(compressImage($_FILES['user_image']['tmp_name'],$location,60)){
	  	$selectQuery = mysqli_query($conn,"INSERT INTO `listing_details` SET `user_id` = '".$_POST['profile_id']."', `property_name` = '".$_POST['p_name']."', `property_type` = '".$_POST['property_type']."', `property_address` = '".$_POST['p_address']."', property_price = '".$_POST['p_price']."', property_open_time = '".$_POST['open_time']."', property_close_time = '".$_POST['close_time']."', `property_details` = '".mysqli_real_escape_string($conn,$_POST['p_details'])."', `property_image` = '".$filemain."', `map_links` = '".mysqli_real_escape_string($conn,$_POST['map_links'])."' ");
	  	$lastP_id = mysqli_insert_id($conn);
	  		}
		}
	
	
	// multiple image upload

		if($_FILES['files']['size'] != 0){
			extract($_POST);
			$valid_ext = ['png','jpeg','jpg'];
			foreach($_FILES['files']['name'] as $key=>$val){
				$filename = $_FILES['files']['name'][$key];
			// Location
			$location = "uploads/property/other_property/".$filename;

			// file extension
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);

			// Check extension
			if(in_array($file_extension,$valid_ext)){

			  // Compress Image
			  if(compressImage($_FILES['files']['tmp_name'][$key],$location,60)){
			  	$insertOtherProperty = mysqli_query($conn,"INSERT INTO `property_images` SET `property_id` = '".$lastP_id."' , `property_images` = '".$filename."'  ");
			  		}
				}
			}
		}

		
	//end of multiple image upload
	if($selectQuery){
		echo "<script>window.location.href='user/add-listing?sucmsg=successfully Inserted'</script>";
	}else{
		echo "<script>window.location.href='user/add-listing?errmsg=something went wrong! Try again'</script>";
	}
	} else{
		$selectQuery = mysqli_query($conn,"INSERT INTO `listing_details` SET `user_id` = '".$_POST['profile_id']."', `property_name` = '".$_POST['p_name']."', `property_type` = '".$_POST['property_type']."', `property_address` = '".$_POST['p_address']."', property_price = '".$_POST['p_price']."', property_open_time = '".$_POST['open_time']."', property_close_time = '".$_POST['close_time']."',`property_details` = '".mysqli_real_escape_string($conn,$_POST['p_details'])."' , `map_links` = '".mysqli_real_escape_string($conn,$_POST['map_links'])."'");
		if($selectQuery){
			echo "<script>window.location.href='user/add-listing?sucmsg=successfully Inserted'</script>";
		}else{
			echo "<script>window.location.href='user/add-listing?errmsg=something went wrong! Try again'</script>";
		}
	}


}
}
// update = 1
if($update == 1){
	 if(isset($_POST['company_save'])){
	 	$updateQuery_reg = mysqli_query($conn,"UPDATE `company_reg` SET contact_person = '".$_POST['contact_person']."', contact_mail = '".$_POST['contact_mail']."', contact_number = '".$_POST['contact_number']."',alt_contact_no = '".$_POST['company_alt_contact']."' WHERE id = '".$_SESSION['company_session_id']."' ");
	 	$select_list_details = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE user_id = '".$_SESSION['company_session_id']."' ");
	 	$fetch_list_details_id = mysqli_fetch_array($select_list_details);
	 	$query_id = $fetch_list_details_id['id'];
		if($_FILES['user_image']['size']!=0){
		extract($_POST);
		$filemain = $_FILES['user_image']['name'];
		$valid_ext = ['png','jpeg','jpg'];
		$location = "uploads/property/".$filemain;
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		if(in_array($file_extension,$valid_ext)){
		  if(compressImage($_FILES['user_image']['tmp_name'],$location,60)){
		  	$selectQuery = mysqli_query($conn,"UPDATE `listing_details` SET `user_id` = '".$_POST['profile_id']."', `property_name` = '".$_POST['p_name']."', `property_type` = '".$_POST['property_type']."', `property_address` = '".$_POST['p_address']."',property_price = '".$_POST['p_price']."', property_open_time = '".$_POST['open_time']."', property_close_time = '".$_POST['close_time']."', `property_details` = '".mysqli_real_escape_string($conn,$_POST['p_details'])."',`map_links` = '".mysqli_real_escape_string($conn,$_POST['map_links'])."' , `property_image` = '".$filemain."' WHERE id = '".$query_id."' ");
		  		}
			}
		if($_FILES['files']['size'] != 0){
			extract($_POST);
			$valid_ext = ['png','jpeg','jpg'];
			foreach($_FILES['files']['name'] as $key=>$val){
				$filename = $_FILES['files']['name'][$key];
			$location = "uploads/property/other_property/".$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			if(in_array($file_extension,$valid_ext)){
			  if(compressImage($_FILES['files']['tmp_name'][$key],$location,60)){
			  	$insertOtherProperty = mysqli_query($conn,"INSERT INTO `property_images` SET `property_id` = '".$query_id."' , `property_images` = '".$filename."'  ");
			  		}
				}
			}
		}
		if($selectQuery){
			echo "<script>window.location.href='user/add-listing?sucmsg=successfully Updated'</script>";
		}else{
			echo "<script>window.location.href='user/add-listing?errmsg=something went wrong! Try again'</script>";
		}
		} else{
			$selectQuery = mysqli_query($conn,"UPDATE `listing_details` SET `user_id` = '".$_POST['profile_id']."', `property_name` = '".$_POST['p_name']."',property_price = '".$_POST['p_price']."', property_open_time = '".$_POST['open_time']."', property_close_time = '".$_POST['close_time']."', `property_type` = '".$_POST['property_type']."', `property_address` = '".$_POST['p_address']."', `map_links` = '".mysqli_real_escape_string($conn,$_POST['map_links'])."' ,`property_details` = '".mysqli_real_escape_string($conn,$_POST['p_details'])."' WHERE id = '".$query_id."' ");
			if($_FILES['files']['size'] != 0){
				extract($_POST);
				$valid_ext = ['png','jpeg','jpg'];
				foreach($_FILES['files']['name'] as $key=>$val){
					$filename = $_FILES['files']['name'][$key];
				$location = "uploads/property/other_property/".$filename;
				$file_extension = pathinfo($location, PATHINFO_EXTENSION);
				$file_extension = strtolower($file_extension);
				if(in_array($file_extension,$valid_ext)){
				  if(compressImage($_FILES['files']['tmp_name'][$key],$location,60)){
				  	$insertOtherProperty = mysqli_query($conn,"INSERT INTO `property_images` SET `property_id` = '".$query_id."' , `property_images` = '".$filename."'  ");
				  		}
					}
				}
			}
			if($selectQuery){
				echo "<script>window.location.href='user/add-listing?sucmsg=successfully Updated'</script>";
			}else{
				echo "<script>window.location.href='user/add-listing?errmsg=something went wrong! Try again'</script>";
			}
		}


	}
}
// Compress image
		function compressImage($source, $destination, $quality) {

		  $info = getimagesize($source);
		  list($width,$height) = getimagesize($source);
		  	if ($info['mime'] == 'image/jpeg') 
		  	  $image = imagecreatefromjpeg($source);

		  	elseif ($info['mime'] == 'image/gif') 
		  	  $image = imagecreatefromgif($source);

		  	elseif ($info['mime'] == 'image/png') 
		  	  $image = imagecreatefrompng($source);

		  	imagejpeg($image, $destination, $quality);
		  	return true;
		}
		// active plans
		$select_actvie_plans = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE status = 1 order by prime_months ASC ");
 ?>

<div class="clearfix"></div>
<div id="dashboard"> 
<?php include'menu.php';?>
<div class="utf_dashboard_content"> 
<div id="titlebar" class="dashboard_gradient">
<div class="row">
<div class="col-md-12">
<h2>Business</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>Business</li>
</ul>
</nav>
</div>
</div>
</div>
<!-- <?php echo $_SESSION['company_session_id']; ?> -->
<?php if(isset($_SESSION['company_session_id'])){
	$select_Company = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE id = '".$_SESSION['company_session_id']."' ");
	$fetch_company = mysqli_fetch_array($select_Company);
?>
<div class="row"> 
<div class="col-lg-12 col-md-12">

<div class="utf_dashboard_list_box margin-top-0">
<h4 class="gray"><i class="sl sl-icon-home"></i>Business</h4>
<div class="utf_dashboard_list_box-static">
	
<div class="my-profile">
<div class="row with-forms">
	<form action="" method="post" enctype="multipart/form-data">
	<?php  
		if($update == 1){
			if(isset($msg)){
				echo "<div class='hide_div'>".$msg."</div>";
			}
		}
	?>
	<?php if(isset($_GET['sucmsg'])){ ?>
	    <p style="color: green;"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
	<?php } else if(isset($_GET['errmsg'])){ ?>
	    <p style="color: red;"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
	<?php } ?>
	<input type="hidden" name="profile_id" value="<?= $_SESSION['company_session_id']; ?>">
	<div class="col-md-4">
	<label>Name</label>						
	<input type="text" class="input-text" placeholder="Alex Daniel" value="<?= $fetch_company['contact_person']; ?>" id="contact_person" name="contact_person">
	</div>
	<div class="col-md-4">
	<label>Phone</label>						
	<input type="text" class="input-text" placeholder="(123) 123-456" value="<?= $fetch_company['contact_number']; ?>" id="contact_number" name="contact_number">
	</div>
	<div class="col-md-4">
	<label>Business</label>						
	<input type="text" class="input-text" placeholder="ABC Company" value="<?= $fetch_company['company_name']; ?>"  name="company_name" readonly>
	</div>
<div class="col-md-4">
<label>Business Type</label>						
<select name="property_type" id="p_type" onchange="property()">
	<option value="">Enter Your Business Type</option>
	<?php $select_category = mysqli_query($conn,"SELECT * FROM `category` "); 
	while($fetch_category = mysqli_fetch_array($select_category)){ ?>
		<option value="<?= $fetch_category['id'] ?>" <?php if($update == 1){ if($fetch_category['id']==$fetch_add_edit['property_type']){ ?> selected <?php }} ?>><?= $fetch_category['category_name']; ?></option>
	<?php } ?>
</select>
</div>
<div class="col-md-4">
<label>Business Name</label>						
<input type="text" class="input-text" placeholder="Enter your business name" value="<?= $fetch_company['company_name'] ?>" name="p_name" readonly>
</div>

<div class="col-md-4">
<label>Business Address</label>	
<select name="p_address" id="user_address">
	<option value="">Choose business location</option>
	<?php $select_location = mysqli_query($conn,"SELECT * FROM `location` ");
	while($fetch_location = mysqli_fetch_array($select_location)){ ?>
		<option value="<?= $fetch_location['location_name']; ?>" <?php if($update == 1){ if($fetch_category['location_name']==$fetch_add_edit['property_address']){ ?> selected <?php }} ?>><?= $fetch_location['location_name']; ?> </option>
	<?php } ?>
</select>					
<!-- <input type="text" class="input-text" placeholder="property address" value="" name="p_address"> -->
</div>
<div class="col-md-12">
<label>Business Details</label>
<textarea name="p_details" cols="30" rows="10" placeholder="Enter your business details"><?php if($update == 1){ echo $fetch_add_edit['property_details']; } ?></textarea>
</div>

<div class="col-md-4">
<label>Price</label>						
<input type="text" class="input-text" placeholder="price" value="<?php if($update == 1){ echo $fetch_add_edit['property_price']; } ?>" name="p_price">
</div>
<div class="col-md-4">
<label>Opening Time</label>						
<input type="time" class="input-text"  value="<?php if($update == 1){ echo $fetch_add_edit['property_open_time']; } ?>" name="open_time">
</div>
<div class="col-md-4">
<label>Closing Time</label>						
<input type="time" class="input-text"  value="<?php if($update == 1){ echo $fetch_add_edit['property_close_time']; } ?>" name="close_time">
</div>
<div class="col-md-4">
<label>Google Map Address</label>						
<input type="text" class="input-text" placeholder="Map Address" value="<?php if($update == 1){ echo $fetch_add_edit['map_links']; } ?>" name="map_links">
</div>
<div class="col-md-4">
<label>Business Email</label>						
<input type="text" class="input-text" name="contact_mail" placeholder="test@example.com" value="<?= $fetch_company['contact_mail']; ?>" id="contact_mail">
</div>
<div class="col-md-4">
<label>Alt Business Contact</label>						
<input type="text" class="input-text" placeholder="alt contact" value="<?= $fetch_company['alt_contact_no']; ?>" name="company_alt_contact">
</div>
<div class="col-md-6">
<label>Upload Image</label>						
<input type="file" name="user_image" class="upload" <?php if($update == 0){ ?> required="required" <?php } ?> >
<p class="mt-20"><small>* must add a business main image</small></p>
<div class="col-md-4">
	<?php if($update == 1){ if($fetch_add_edit['property_image'] !=''){ ?>
	<img src="user/uploads/property/<?= $fetch_add_edit['property_image'] ?>">

	<?php }else{
		echo "<p>No Property Image Added<p>";
	} } ?>
</div>
</div>
<div class="col-md-6">
<label>Upload Others Image</label>						
<input type="file" name="files[]" class="upload" multiple>
<p class="mt-20"><small>* You can upload others photograph of your business</small></p>
<?php if($update == 1){ 
$selectOtherImg = mysqli_query($conn,"SELECT * FROM `property_images` WHERE property_id = '".$fetch_add_edit[0]."' ");
if(mysqli_num_rows($selectOtherImg)>0){ ?>
<div class="col-md-12">
	<?php while($fetchOtherImg = mysqli_fetch_array($selectOtherImg)){ ?>
	<div class="col-md-4">
		<img src="user/uploads/property/other_property/<?= $fetchOtherImg['property_images']; ?>">
		<a href="user/add-listing.php?del_o_id=<?= $fetchOtherImg['id']; ?>" class="center-align text-red"><i class="fa fa-times"></i></a>
	</div>
	<?php } ?>
</div>
<?php } } ?>
</div>
<div class="col-sm-12">
	<button type="submit" class="button preview btn_center_item margin-top-15" name="company_save">Save Changes</button>
</div>
</form>
</div>
<div class="row with-forms" style="margin-top: 40px;">
	<form action="" method="post">
		<div class="col-md-12">
			<?php
			 $check_premium_not_id = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE id = '".$_SESSION['company_session_id']."' AND prime_id <> 0 ");
					if(mysqli_num_rows($check_premium_not_id)>0){
						$fetch_prime_msg = mysqli_fetch_array($check_premium_not_id);
						echo "<p style='color:green'>Your premium membership valid till ".date('d M,Y',strtotime($fetch_prime_msg['prime_end_date']))." </p>";
					} ?>
			<h3 style="text-align: center;text-decoration: underline;" class="text-primary">Buy A Premium Plan</h3>
			<?php  
				if($update == 1){
					if(isset($prime_msg)){
						echo "<div class='hide_div'>".$prime_msg."</div>";
					}
				}
			?>
		</div>
	<div class="col-md-6">
	<label>Choose Payment Method</label>		
	<select name="mode_of_payment" <?php if(!isset($_SESSION['price_plans'])){ ?> required="required" <?php } ?> onchange="paytype(this)" id="mode_of_payment">
		<option value="">Choose payment type</option>
		<option value="Cheque" <?php if($fetch_company['payment_mode']=='Cheque'){ ?> selected <?php } ?>>Cheque</option>
		<option value="Cash" <?php if($fetch_company['payment_mode']=='Cash'){ ?> selected <?php } ?>>Cash</option>
		<option value="Online Payment" <?php if($fetch_company['payment_mode']=='Online Payment'){ ?> selected <?php } ?>>Online Payment</option>
	</select>
	<p class="below-text"><small>* Buy a premium membership plan</small></p>
	<input type="hidden" name="p_c_show" id="p_c_show" value="<?php if(isset($_SESSION['price_plans'])){ echo $_SESSION['price_plans']; } ?>">
	</div>
	<div class="col-md-6" id="on_pay_div">
	<label>Choose Listing Type</label>						
	<select name="choose_listing_type1" id="choose_listing_type" onchange="list_change()">
		<?php if(isset($_SESSION['pay_suc'])){ ?>
			<?php if($_SESSION['pay_suc']==1){ ?>
				<option value="0" >Free Plan</option>
				<?php while($fetch_all_payment = mysqli_fetch_array($select_actvie_plans)){ ?>
				<option value="<?= $fetch_all_payment['prime_months'] ?>" <?php if($_SESSION['price_plans'] == $fetch_all_payment['prime_months']){ ?> selected <?php } ?>><?= $fetch_all_payment['prime_months']." months" ?></option>
			<?php } }else if($_SESSION['pay_suc']==0){ ?>
				<option value="0" >Free Plan</option>
				<?php while($fetch_all_payment = mysqli_fetch_array($select_actvie_plans)){ ?>
				<option value="<?= $fetch_all_payment['prime_months'] ?>" <?php if($fetch_company['prime_id'] == $fetch_all_payment['id']){ ?> selected <?php } ?>><?= $fetch_all_payment['prime_months']." months" ?></option>
				<?php } ?>
		<?php } }else{ ?>
			<option value="0" selected="selected">Free Plan</option>
			<?php while($fetch_all_payment = mysqli_fetch_array($select_actvie_plans)){ ?>
			<option value="<?= $fetch_all_payment['prime_months']; ?>"><?= $fetch_all_payment['prime_months']." months" ?></option>
			<?php } ?>
		<?php } ?>
	</select>
	<input type="hidden" id="hidden_price" name="hidden_price" value="">						
	</div>
	<div class="col-md-6" id="normal_pay_div">
		<label>Choose Listing Type</label>
		<select id="choose_listing_type" name="choose_listing_type">
			<option value="0">Free Listing</option>
			<?php $select_ac_plan = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE status = 1 ORDER BY prime_months "); while($fetch_ac_list = mysqli_fetch_array($select_ac_plan)){ ?>
				<option value="<?= $fetch_ac_list['prime_months']; ?>" <?php if($fetch_ac_list['prime_months']==$fetch_company['prime_id']){ ?> selected <?php } ?> ><?= $fetch_ac_list['prime_months'].' months plan'; ?></option>
			<?php } ?>
		</select>	
	</div>
	<div class="col-md-12">
		<button type="submit" class="button preview btn_center_item margin-top-15" name="company_member_prime">Save Changes</button>
	</div>
	</form>
</div>

	
</div>

</div>
</div>

</div>

<?php include'copy.php';?>

</div>
<?php } ?>

</div>
	
</div>
</div>

<?php include'../scripts.php';?>
<script type="text/javascript">
	function property(){
		var p_type = $("#p_type").val();
		
	}
		function list_change(){
			var choose_listing_type = $("#choose_listing_type").val();
			$.ajax({
				url: 'user/ajax-check-price',
				type: 'post',
				dataType: 'json',
				data: {choose_listing_type:choose_listing_type},
				success: function(event){
					console.log(event);
					if(event.no_error){
						var prime_price = event.no_error;
						$("#hidden_price").val(prime_price);
						var hidden_price = $("#hidden_price").val();
						payuredirect(hidden_price);
					}else if(event.main_error){
						var error_in_price = event.main_error;
						alert(error_in_price);
					}
				}
			})
		}
		function payuredirect(hidden_price){

			var name = $("#contact_person").val();
			var contact = $("#contact_number").val();
			var email = $("#contact_mail").val();
			var address = $("#user_address").val();
			var plans = $("#choose_listing_type").val();
			var price = hidden_price;
			$.ajax({
				url: 'user/ajax-session-destails',
				type: 'post',
				dataType: 'json',
				data: {name:name,contact:contact,email:email,address:address,plans:plans,price:price},
				success: function(event){
					console.log(event);
					if(event.suc_msg){
					window.location.href='user/payment/payumoney_form?name='+name+'&contact='+contact+'&email='+email+'&address='+address+'&price='+price+'&plans='+plans;
					}
				}
			})
			
		}
		$(function(){
			$("#on_pay_div").hide();
			var tt = $("#p_c_show").val();
			if(tt != ''){
				$("#on_pay_div").show();
				$("#normal_pay_div").hide();
			}else{
				$("#on_pay_div").hide();
				$("#normal_pay_div").show();
			}
		})

		function paytype(data){
			if(data.value == 'Online Payment'){
				$("#on_pay_div").show();
				$("#normal_pay_div").hide();
			}else{
				$("#on_pay_div").hide();
				$("#normal_pay_div").show();
			}
		}
		$(function(){
			window.setTimeout(function(){
				$(".hide_div").hide();
			},2000);
		})
</script>
</body>
</html>