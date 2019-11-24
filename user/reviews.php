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
<h2>View Reviews</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>View Reviews</li>
</ul>
</nav>
</div>
</div>
</div>
<!-- <?php echo $_SESSION['company_session_id']; ?> -->
<?php if(isset($_SESSION['company_session_id'])){ ?>
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
			<th>Property Name</th>
			<th>Customer </th>
			<th>Customer Review</th>
			<th>Customer Rating</th>
			<th>Posted On</th>
			<!-- <th>Property Rating</th> -->
		</thead>
		<tbody>
			<?php $i = 1;
			$selectEnquiry = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN `company_reg` ON customer_reviews.company_id = company_reg.id  WHERE customer_reviews.company_id = '".$_SESSION['company_session_id']."' ORDER BY customer_reviews.id DESC");
			 while($fetchEnquiry = mysqli_fetch_array($selectEnquiry)){
			 	$select_Property = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE id = '".$fetchEnquiry['property_id']."'  ");
			 	$fetch_property = mysqli_fetch_array($select_Property);
			 ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= $fetch_property['property_name']; ?></td>
				<td><?= $fetchEnquiry['customer_name']; ?></td>
				<td style="width: 40%" id="add_view<?= $i; ?>"><?php  if(strlen($fetchEnquiry['customer_review'])>100){ echo substr($fetchEnquiry['customer_review'],0,100)."...  <a href='javascript:;'  onclick='view_more(".$fetchEnquiry[0].",".$i.")'><i class='fa fa-plus' style='color:blue;'></a></button>";  }else{ echo $fetchEnquiry['customer_review']; } ?></td>
				<td><?php for($i=1;$i<=$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" id="star-yellow"></i> <?php } ?><?php for($i=1;$i<=(5-$fetchEnquiry['customer_rating']);$i++){ ?> <i class="fa fa-star"></i> <?php } ?></td>
				<td><?= date('M d,Y H:i a',strtotime($fetchEnquiry['review_posted_on'])); ?></td>

				<!-- <td><?php for($i=1;$i<$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" id="star-yellow"></i> <?php } for($i=1;$i<5-$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" ></i> <?php } ?></td> -->
			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>
	<!-- Modal -->
	<!-- Modal -->
	
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
	function view_more(data,countid){
		$.ajax({
		  url: 'user/ajax-full-reviews',
		  type: 'post',
		  data: {data:data,countid:countid},
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#add_view"+countid).empty();
		      $("#add_view"+countid).append(event.no_error);
		    }else if(event.main_error){
		      $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		    }
		  }
		});
	}
	function view_less(data,countid){
		$.ajax({
		  url: 'user/ajax-less-reviews',
		  type: 'post',
		  data: {data:data,countid:countid},
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#add_view"+countid).empty();
		      $("#add_view"+countid).append(event.no_error);
		    }else if(event.main_error){
		      $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		    }
		  }
		});
	}
</script>
</body>
</html>
