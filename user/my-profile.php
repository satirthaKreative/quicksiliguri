<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Quick Siliguri</title>
<meta http-equiv="refresh" content="86400">
<?php include'../style.php';?>
<body>

<div id="main_wrapper">
<?php include'header.php'; ?>
<!-- Prime Session Check -->
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
<!-- /Prime Session -->

<?php if(isset($_POST['company_save'])){

	if($_FILES['user_image']['size']!=0){
	$new_img = uniqid().$_FILES['user_image']['name'];
	move_uploaded_file($_FILES['user_image']['tmp_name'], "uploads/".$new_img);
	if($_POST['choose_listing_type'] != 0){
		$today_prime = date('Y-m-d');
		$effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($today_prime)));
	}else{
		$today_prime = null;
		$effectiveDate = null;
	}
	$selectQuery = mysqli_query($conn,"UPDATE `company_reg` SET `company_name`='".$_POST['company_name']."',`contact_person`='".$_POST['contact_person']."',`contact_mail`='".$_POST['contact_mail']."',`contact_number`='".$_POST['contact_number']."',`alt_contact_no`='".$_POST['alt_contact_no']."',`user_pass`='".md5($_POST['user_pass'])."',`user_org_pass`='".$_POST['user_pass']."',`user_address`='".$_POST['user_address']."',`map_link`='".mysqli_real_escape_string($conn,$_POST['map_link'])."',prime_id = '".$_POST['choose_listing_type']."', prime_start_date = '".$today_prime."', payment_mode = '".$_POST['mode_of_payment']."' , prime_end_date = '".$effectiveDate."',`user_image`='".$new_img."' WHERE `id`= '".$_SESSION['company_session_id']."' ");
	if($selectQuery){
		echo "<script>window.location.href='user/my-profile?sucmsg=successfully Updated'</script>";
	}else{
		echo "<script>window.location.href='user/my-profile?errmsg=something went wrong! Try again'</script>";
	}
	} else{
		if($_POST['choose_listing_type'] != 0){
			$today_prime = date('Y-m-d');
			$effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime($today_prime)));
		}else{
			$today_prime = null;
			$effectiveDate = null;
		}
		$selectQuery = mysqli_query($conn,"UPDATE `company_reg` SET `company_name`='".$_POST['company_name']."',`contact_person`='".$_POST['contact_person']."',`contact_mail`='".$_POST['contact_mail']."',`contact_number`='".$_POST['contact_number']."',`alt_contact_no`='".$_POST['alt_contact_no']."',`user_pass`='".md5($_POST['user_pass'])."',`user_org_pass`='".$_POST['user_pass']."',`user_address`='".$_POST['user_address']."',`map_link`='".mysqli_real_escape_string($conn,$_POST['map_link'])."',payment_mode = '".$_POST['mode_of_payment']."' ,prime_id = '".$_POST['choose_listing_type']."', prime_start_date = '".$today_prime."', prime_end_date = '".$effectiveDate."' WHERE `id`= '".$_SESSION['company_session_id']."' ");
		if($selectQuery){
			echo "<script>window.location.href='user/my-profile?sucmsg=successfully Updated'</script>";
		}else{
			echo "<script>window.location.href='user/my-profile?errmsg=something went wrong! Try again'</script>";
		}
	}


}

// user one
if(isset($_POST['save_user'])){
	if($_FILES['user_image']['size']!=0){
	$new_img = uniqid().$_FILES['user_image']['name'];
	move_uploaded_file($_FILES['user_image']['tmp_name'], "uploads/".$new_img);
	$selectQuery = mysqli_query($conn,"UPDATE `customer_tbl` SET `user_name`='".$_POST['user_name']."',`user_contact`='".$_POST['user_contact']."',`user_image`='".$new_img."',`user_email`='".$_POST['user_email']."',`user_address`='".mysqli_real_escape_string($conn,$_POST['u_address'])."' WHERE id = '".$_SESSION['front_user_id']."' ");
	if($selectQuery){
		echo "<script>window.location.href='user/my-profile?sucmsg=successfully Updated'</script>";
    }else{
		echo "<script>window.location.href='user/my-profile?errmsg=something went wrong! Try again'</script>";
	}
	} else{
		$selectQuery = mysqli_query($conn,"UPDATE `customer_tbl` SET `user_name`='".$_POST['user_name']."',`user_contact`='".$_POST['user_contact']."',`user_email`='".$_POST['user_email']."',`user_address`='".mysqli_real_escape_string($conn,$_POST['u_address'])."' WHERE id = '".$_SESSION['front_user_id']."' ");
		if($selectQuery){
			echo "<script>window.location.href='user/my-profile?sucmsg=successfully Updated'</script>";
		}else{
			echo "<script>window.location.href='user/my-profile?errmsg=something went wrong! Try again'</script>";
		}
	}


}
// show all active premium plans
$select_actvie_plans = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE status = 1 ");
 ?>

<div class="clearfix"></div>
<div id="dashboard"> 
<?php include'menu.php';?>

<div class="utf_dashboard_content"> 
<div id="titlebar" class="dashboard_gradient">
<div class="row">
<div class="col-md-12">
<h2>My Profile</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>My Profile</li>
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
<form action="" method="post" enctype="multipart/form-data">
<div class="utf_dashboard_list_box margin-top-0">
<h4 class="gray"><i class="sl sl-icon-user"></i> Profile Details</h4>
<div class="utf_dashboard_list_box-static">
	<?php if(isset($_GET['sucmsg'])){ ?>
	<div class="alert alert-success">
		<p style="color:green;"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
	</div>
	<?php } else if(isset($_GET['errmsg'])){ ?>
	<div class="alert alert-danger">
		<p style="color:red;"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
	</div>
	<?php } ?>
<div class="edit-profile-photo"> <img src="<?php if(($fetch_company['user_image']!='' )|| ($fetch_company['user_image']!=0)){ echo "user/uploads/".$fetch_company['user_image']; }else{ echo  'images/user-avatar.jpg'; } ?>" alt="">
<div class="change-photo-btn">
<div class="photoUpload"> <span><i class="fa fa-upload"></i> Upload Photo</span>
<input type="file" class="upload" name="user_image">
</div>
</div>
</div>
<div class="my-profile">
<div class="row with-forms">
<div class="col-md-4">
<label>Name</label>						
<input type="text" class="input-text" placeholder="Alex Daniel" value="<?= $fetch_company['contact_person']; ?>" id="contact_person" name="contact_person">
</div>
<div class="col-md-4">
<label>Phone</label>						
<input type="text" class="input-text" placeholder="(123) 123-456" value="<?= $fetch_company['contact_number']; ?>" id="contact_number" name="contact_number">
</div>
<div class="col-md-4">
<label>Company</label>						
<input type="text" class="input-text" placeholder="ABC Company" value="<?= $fetch_company['company_name']; ?>"  name="company_name" readonly>
</div>
<div class="col-md-4">
<label>Email</label>						
<input type="text" class="input-text" name="contact_mail" placeholder="test@example.com" value="<?= $fetch_company['contact_mail']; ?>" id="contact_mail">
</div>
<div class="col-md-4">
<label>Alternate Contact</label>
<input type="text" class="input-text" placeholder="alternate contact number" name="alt_contact_no" value="<?= $fetch_company['alt_contact_no']; ?>">						
</div>
<div class="col-md-4">
<label>Password</label>
<input type="text" class="input-text" placeholder="Enter your password" name="user_pass" value="<?= $fetch_company['user_org_pass']; ?>">						
</div>
<div class="col-md-12">
<label>Address</label>
<textarea name="user_address" id="user_address" cols="30" rows="10" placeholder="Enter your address"><?= $fetch_company['user_address']; ?></textarea>
</div>
	
<div class="col-md-4">
<label>Choose Payment Method</label>						
<select name="mode_of_payment" required="required" onchange="paytype(this)" id="mode_of_payment">
	<option value="">Choose payment type</option>
	<option value="Cheque" <?php if($fetch_company['payment_mode']=='Cheque'){ ?> selected <?php } ?>>Cheque</option>
	<option value="Cash" <?php if($fetch_company['payment_mode']=='Cash'){ ?> selected <?php } ?>>Cash</option>
	<option value="Online Payment" <?php if($fetch_company['payment_mode']=='Online Payment'){ ?> selected <?php } ?>>Online Payment</option>
</select>
<p class="below-text"><small>* Buy a premium membership plan</small></p>
</div>								
<div class="col-md-4" id="on_pay_div">
<label>Choose Listing Type</label>						
<select name="choose_listing_type" id="choose_listing_type" onchange="list_change()">
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
<div class="col-md-4" id="normal_pay_div">
	<label>Choose Listing Type</label>
	<select id="choose_listing_type" name="choose_listing_type">
		<option value="0">Free Listing</option>
		<?php $select_ac_plan = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE status = 1 ORDER BY prime_months "); while($fetch_ac_list = mysqli_fetch_array($select_ac_plan)){ ?>
			<option value="<?= $fetch_ac_list['prime_months']; ?>" <?php if($fetch_ac_list['prime_months']==$fetch_company['prime_id']){ ?> selected <?php } ?> ><?= $fetch_ac_list['prime_months'].' months plan'; ?></option>
		<?php } ?>
	</select>
<input type="hidden" class="input-text" placeholder="google map link" name="map_link" value="<?= $fetch_company['map_link']; ?>">	
</div>
	


</div>	
</div>
<button type="submit" class="button preview btn_center_item margin-top-15" name="company_save">Save Changes</button>
</div>
</div>
</form>
</div>

<?php include'copy.php';?>

</div>
<?php }else if(isset($_SESSION['front_user_id'])){ ?>
<!-- user part -->
<div class="row"> 
<div class="col-lg-12 col-md-12">
	<p id="profile_success_msg"></p>
<div class="utf_dashboard_list_box margin-top-0">
<h4 class="gray"><i class="sl sl-icon-user"></i> Profile Details</h4>
<form action="" method="post" enctype="multipart/form-data">
	<div class="utf_dashboard_list_box-static"> 
	<?php if(isset($_GET['sucmsg'])){ ?>
	<div class="alert alert-success">
		<p style="color:green;"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
	</div>
	<?php } else if(isset($_GET['errmsg'])){ ?>
	<div class="alert alert-danger">
		<p style="color:red;"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
	</div>
	<?php } ?>
	<div class="edit-profile-photo"> <img src="<?php if(($fetch_header_name['user_image']!='' )|| ($fetch_header_name['user_image']!=0)){ echo "user/uploads/".$fetch_header_name['user_image']; }else{ echo 'images/user-avatar.jpg'; } ?>" alt="">
	<div class="change-photo-btn">
	<div class="photoUpload"> <span><i class="fa fa-upload"></i> Upload Photo</span>
	<input type="file" class="upload" name="user_image">
	</div>
	</div>
	</div>
	<div class="my-profile">
	<div class="row with-forms">
	<div class="col-md-4">
	<label>Name</label>						
	<input type="text" class="input-text" placeholder="Enter Your Name" name="user_name" value="<?= $fetch_header_name['user_name']; ?>">
	</div>
	<div class="col-md-4">
	<label>Phone</label>						
	<input type="text" class="input-text" placeholder="Enter Your Phone Number" name="user_contact" value="<?= $fetch_header_name['user_contact']; ?>">
	</div>
	<div class="col-md-4">
	<label>Email</label>						
	<input type="text" class="input-text" placeholder="test@example.com" name="user_email" value="<?= $fetch_header_name['user_email']; ?>">
	</div>
	<div class="col-md-12">
	<label>Address</label>
	<textarea  cols="30" rows="10" placeholder="Enter Your Address" name="u_address"><?= $fetch_header_name['user_address']; ?></textarea>
	</div>

	</div>	
	</div>
	<button type="submit" name="save_user" class="button btn_center_item margin-top-15">Save Changes</button>
	</div>
</form>

</div>
</div>

<?php include'copy.php';?>

</div>
<!-- /user part -->
<?php } ?>

</div>
	
</div>
</div>

<?php include'../scripts.php';?>
<script type="text/javascript">
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
				if(event.suc_msg){
				window.location.href='user/payment/payumoney_form?name='+name+'&contact='+contact+'&email='+email+'&address='+address+'&price='+price+'&plans='+plans;
				}
			}
		})
		
	}
	$(function(){
		$("#on_pay_div").hide();
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
</script>
</body>
</html>