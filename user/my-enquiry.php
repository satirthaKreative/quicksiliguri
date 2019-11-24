<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enquiry - Quick Siliguri</title>
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
<h2>View Enquiry</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>View Enquiry</li>
</ul>
</nav>
</div>
</div>
</div>
<!-- <?php echo $_SESSION['company_session_id']; ?> -->
<?php if(isset($_SESSION['front_user_id'])){ ?>
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
			<th>Your Enquiry</th>
			<th>Description</th>
			<!-- <th>Property Rating</th> -->
		</thead>
		<tbody>
			<?php $i = 1;
			$selectEnquiry = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN `listing_details` ON customer_enquiry.property_id = listing_details.id  WHERE customer_enquiry.customer_id = '".$_SESSION['front_user_id']."' ORDER BY customer_enquiry.id DESC");
			 while($fetchEnquiry = mysqli_fetch_array($selectEnquiry)){ ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= $fetchEnquiry['property_name']; ?></td>
				<td style="width: 40%" ><?= $fetchEnquiry['customer_enquiry']; ?></td>
				<td><b>Owner can contact you via email</b></td>

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
		  url: 'user/ajax-full-query',
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
		  url: 'user/ajax-less-query',
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
