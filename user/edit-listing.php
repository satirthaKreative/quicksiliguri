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
<style type="text/css">
	.center-align{ text-align: center !important; }
	.text-red{ color: red; }
</style>
<div id="main_wrapper">
<?php include'header.php';?>

<?php
if(isset($_GET['cate_name'])){
  $getCate = explode('1A01',$_GET['cate_name']);
  $query_id = $getCate[0];
  $selectCategory = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE id = '".$query_id."' ");
  $fetchCategory = mysqli_fetch_array($selectCategory);
}
 if(isset($_POST['company_save'])){
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
	  	$selectQuery = mysqli_query($conn,"UPDATE `listing_details` SET `user_id` = '".$_POST['profile_id']."', `property_name` = '".$_POST['p_name']."', `property_type` = '".$_POST['property_type']."', `property_address` = '".$_POST['p_address']."',property_price = '".$_POST['p_price']."', property_open_time = '".$_POST['open_time']."', property_close_time = '".$_POST['close_time']."', `property_details` = '".mysqli_real_escape_string($conn,$_POST['p_details'])."',`map_links` = '".mysqli_real_escape_string($conn,$_POST['map_links'])."' , `property_image` = '".$filemain."' WHERE id = '".$query_id."' ");
	  		}
		}
	
	// insert other images
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
		  	$insertOtherProperty = mysqli_query($conn,"INSERT INTO `property_images` SET `property_id` = '".$query_id."' , `property_images` = '".$filename."'  ");
		  		}
			}
		}
	}
	if($selectQuery){
		echo "<script>window.location.href='user/view-listing?sucmsg=successfully Updated'</script>";
	}else{
		echo "<script>window.location.href='user/view-listing?errmsg=something went wrong! Try again'</script>";
	}
	} else{
		$selectQuery = mysqli_query($conn,"UPDATE `listing_details` SET `user_id` = '".$_POST['profile_id']."', `property_name` = '".$_POST['p_name']."',property_price = '".$_POST['p_price']."', property_open_time = '".$_POST['open_time']."', property_close_time = '".$_POST['close_time']."', `property_type` = '".$_POST['property_type']."', `property_address` = '".$_POST['p_address']."', `map_links` = '".mysqli_real_escape_string($conn,$_POST['map_links'])."' ,`property_details` = '".mysqli_real_escape_string($conn,$_POST['p_details'])."' WHERE id = '".$query_id."' ");
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
			  	$insertOtherProperty = mysqli_query($conn,"INSERT INTO `property_images` SET `property_id` = '".$query_id."' , `property_images` = '".$filename."'  ");
			  		}
				}
			}
		}
		if($selectQuery){
			echo "<script>window.location.href='user/view-listing?sucmsg=successfully Updated'</script>";
		}else{
			echo "<script>window.location.href='user/view-listing?errmsg=something went wrong! Try again'</script>";
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

 ?>



<div class="clearfix"></div>
<div id="dashboard"> 
<?php include'menu.php';?>

<div class="utf_dashboard_content"> 
<div id="titlebar" class="dashboard_gradient">
<div class="row">
<div class="col-md-12">
<h2>Edit Business</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>Edit Business</li>
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
<h4 class="gray"><i class="sl sl-icon-home"></i> Edit Business</h4>
<div class="utf_dashboard_list_box-static">
	
<div class="my-profile">
<div class="row with-forms">
	<?php if(isset($_GET['sucmsg'])){ ?>
	    <p style="color: green;"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
	<?php } else if(isset($_GET['errmsg'])){ ?>
	    <p style="color: red;"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
	<?php } ?>
	<input type="hidden" name="profile_id" value="<?= $_SESSION['company_session_id']; ?>">
<div class="col-md-4">
<label>Business Type</label>						
<select name="property_type" id="p_type" onchange="property()">
	<option value="">Enter Your Business Type</option>
	<?php $select_category = mysqli_query($conn,"SELECT * FROM `category` "); 
	while($fetch_category = mysqli_fetch_array($select_category)){ ?>
		<option value="<?= $fetch_category['id'] ?>" <?php if($fetchCategory['property_type']==$fetch_category['id']){ ?> selected <?php } ?>><?= $fetch_category['category_name']; ?></option>
	<?php } ?>
</select>
</div>
<div class="col-md-4">
<label>Business Name</label>						
<input type="text" class="input-text" placeholder="property address" value="<?= $fetchCategory['property_name'] ?>" name="p_name">
</div>

<div class="col-md-4">
<label>Business Address</label>						

<select name="p_address">
<option value="">Choose business location</option>
<?php $select_location = mysqli_query($conn,"SELECT * FROM `location` ");
while($fetch_location = mysqli_fetch_array($select_location)){ ?>
	<option value="<?= $fetch_location['location_name']; ?>" <?php if($fetch_location['location_name'] == $fetchCategory['property_address']){ ?> Selected <?php } ?> ><?= $fetch_location['location_name']; ?> </option>
<?php } ?>
</select>
</div>
<div class="col-md-12">
<label>Business Details</label>
<textarea name="p_details" cols="30" rows="10" placeholder="Enter your property details"><?= $fetchCategory['property_details'] ?></textarea>
</div>
<div class="col-md-6">
<label>Upload Image</label>						
<input type="file" name="user_image" class="upload">
<p class="mt-20"><small>* Business main image</small></p>
<div class="col-md-4">
	<?php if($fetchCategory['property_image'] !=''){ ?>
	<img src="user/uploads/property/<?= $fetchCategory['property_image'] ?>">

	<?php }else{
		echo "<p>No Property Image Added<p>";
	} ?>
</div>
</div>
<div class="col-md-6">
<label>Upload Others Image</label>						
<input type="file" name="files[]" class="upload" multiple>
<p class="mt-20"><small style="color: red;">* Size Must be (1280*720)</small><br><small>* You can upload others photograph of your business</small></p>
<?php $selectOtherImg = mysqli_query($conn,"SELECT * FROM `property_images` WHERE property_id = '".$fetchCategory['id']."' ");
if(mysqli_num_rows($selectOtherImg)>0){ ?>
<div class="col-md-12">
	<?php while($fetchOtherImg = mysqli_fetch_array($selectOtherImg)){ ?>
	<div class="col-md-4">
		<img src="user/uploads/property/other_property/<?= $fetchOtherImg['property_images']; ?>">
		<a href="#" class="center-align text-red" onclick="deleteImg(<?= $fetchOtherImg['id']; ?>);"><i class="fa fa-times"></i></a>
	</div>
	<?php } ?>
</div>
<?php } ?>
<p class="sucDelmsg"></p>
</div>
<div class="col-md-4">
<label>Price</label>						
<input type="text" class="input-text" placeholder="price" value="<?= $fetchCategory['property_price'] ?>" name="p_price">
</div>
<div class="col-md-4">
<label>Opening Time</label>						
<input type="time" class="input-text"  value="<?= $fetchCategory['property_open_time'] ?>" name="open_time">
</div>
<div class="col-md-4">
<label>Closing Time</label>						
<input type="time" class="input-text"  value="<?= $fetchCategory['property_close_time'] ?>" name="close_time">
</div>
<div class="col-md-4">
<label>Google Map Address</label>						
<input type="text" class="input-text" placeholder="Map Address" value="<?= $fetchCategory['map_links']; ?>" name="map_links">
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
<?php } ?>

</div>
	
</div>
</div>

<?php include'../scripts.php';?>
<!-- <script>
    CKEDITOR.replace( 'p_details' );
</script> -->
<script type="text/javascript">
	function property(){
		var p_type = $("#p_type").val();
		
	}
	function deleteImg(delId){
		if(confirm("Are you sure?") == true){
			$.ajax({
			  url: 'user/ajax_delete_image',
			  type: 'post',
			  data: {delId:delId},
			  dataType: 'json',
			  success: function(event){
			  	console.log(event);
			    if(event.no_error){
			      $(".sucDelmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(2000).fadeOut('slow');
			      window.setTimeout(function() {
			          window.location.href = 'user/view-listing';
			      }, 2000);
			    }else if(event.main_error){
			      $(".sucDelmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
			    }
			  }
			});
		}else{
			window.location.href = 'user/view-listing';
		}

	}
</script>
</body>
</html>