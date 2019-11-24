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
<?php if(isset($_GET['cate_name'])){
  $getCate = explode('1A01',$_GET['cate_name']);
  $query_id = $getCate[0];
  $selectCategory = mysqli_query($conn,"DELETE FROM `listing_details` WHERE id = '".$query_id."' ");
  if($selectCategory){
    echo "<script>window.location.href='user/view-listing?sucmsg=Data deleted successfuly '</script>";
  } else{
    echo "<script>window.location.href='user/view-listing?errmsg=Something went error!Try again later'</script>";
  }
} ?>

<div class="clearfix"></div>
<div id="dashboard"> 
<?php include'menu.php';?>

<div class="utf_dashboard_content"> 
<div id="titlebar" class="dashboard_gradient">
<div class="row">
<div class="col-md-12">
<h2>View Listing</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>View Listing</li>
</ul>
</nav>
</div>
</div>
</div>
<!-- <?php echo $_SESSION['company_session_id']; ?> -->
<?php if(isset($_SESSION['company_session_id'])){
	$select_Company = mysqli_query($conn,"SELECT * FROM `listing_details`  WHERE user_id = '".$_SESSION['company_session_id']."' ");

?>
<div class="row"> 
<div class="col-lg-12 col-md-12">
	<?php if(isset($_GET['sucmsg'])){ ?>
	    <p style="color: green;"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
	<?php } else if(isset($_GET['errmsg'])){ ?>
	    <p style="color: red;"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
	<?php } ?>
<div style="padding: 40px;background: #fff;border-radius: 15px;box-shadow: 2px 3px #eee;">
	<table id="myTable" class="table table-bordered" style="padding: 20px;">
		<thead>
			<th>#</th>
			<th>Property Image</th>
			<th>Property Name</th>
			<th>Property Details</th>
			<th>Property Address</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php $i = 1; while($fetch_company = mysqli_fetch_array($select_Company)){ ?>
			<tr>
				<td><?= $i; ?></td>
				<td><img src="user/uploads/property/<?= $fetch_company['property_image']; ?>" width="100px"></td>
				<td><?= $fetch_company['property_name']; ?></td>
				<td><?php if(strlen($fetch_company['property_details'])>100){ echo substr($fetch_company['property_details'],0,100)."..."; }else{ echo $fetch_company['property_details']; } ?></td>
				<td><?= $fetch_company['property_address']; ?></td>
				<td><a class="btn btn-sm btn-danger" style="color: blue" href="user/edit-listing.php?cate_name=<?php echo $fetch_company['id']."1A01".$fetch_company['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <a style="color: red;" href="user/view-listing.php?cate_name=<?php echo $fetch_company['id']."1A01".$fetch_company['id']; ?>"  class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>
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
</script>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
</script>
</body>
</html>
