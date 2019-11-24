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
			<th>Customer </th>
			<th>Customer Enquiry</th>
			<th>Mail To </th>
			<th>Call To </th>
			<!-- <th>Property Rating</th> -->
		</thead>
		<tbody>
			<?php $i = 1;
			$selectEnquiry = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN `company_reg` ON customer_enquiry.company_id = company_reg.id  WHERE customer_enquiry.company_id = '".$_SESSION['company_session_id']."' AND company_reg.prime_id != 0 ORDER BY customer_enquiry.id  DESC");
				if(mysqli_num_rows($selectEnquiry)>0){
			 while($fetchEnquiry = mysqli_fetch_array($selectEnquiry)){ ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= $fetchEnquiry['customer_name']; ?></td>
				<td style="width: 40%" id="add_view<?= $i; ?>"><?php  if(strlen($fetchEnquiry['customer_enquiry'])>100){ echo substr($fetchEnquiry['customer_enquiry'],0,100)."...  <a href='javascript:;'  onclick='view_more(".$fetchEnquiry[0].",".$i.")'><i class='fa fa-plus' style='color:blue;'></a></button>";  }else{ echo $fetchEnquiry['customer_enquiry']; } ?></td>
				<td><a id="color-blue" href="mailto:<?= $fetchEnquiry['customer_email']; ?>"><i class="fa fa-envelope-o"></i> Mail Customer</a></td>
				<td><a id="color-blue" href="tel:<?= $fetchEnquiry['customer_contact']; ?>"><i class="fa fa-phone"></i><?= $fetchEnquiry['customer_contact']; ?></a></td>

				<!-- <td><?php for($i=1;$i<$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" id="star-yellow"></i> <?php } for($i=1;$i<5-$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" ></i> <?php } ?></td> -->
			</tr>
			<?php $i++; } } else{ ?>
				<?php $check_not = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE company_reg.prime_id != 0 AND company_reg.id = '".$_SESSION['company_session_id']."'");$fetch_check_not = mysqli_fetch_array($check_not); if($fetch_check_not>0){ ?>
				<td colspan="5" style="color: #000;font-weight: bold;text-align: center;font-size: 18px;">* No enquiry listed </td>
				<?php }else{ ?>
				<?php 
					// echo "SELECT * FROM `customer_enquiry` INNER JOIN `company_reg` ON customer_enquiry.company_id = company_reg.id  WHERE customer_enquiry.company_id = '".$_SESSION['company_session_id']."' AND company_reg.prime_id = 0 ORDER BY customer_enquiry.id  DESC DESC LIMIT 1  ";
					$one_enquiry_saw = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN `company_reg` ON customer_enquiry.company_id = company_reg.id  WHERE customer_enquiry.company_id = '".$_SESSION['company_session_id']."' AND company_reg.prime_id = 0 ORDER BY customer_enquiry.id  DESC LIMIT 1  ");
					$see_one_enquiry = mysqli_fetch_array($one_enquiry_saw);
					$current_date = strtotime('Y-m-d');
					$last_date = strtotime(date('Y-m-d',strtotime($see_one_enquiry['added_on'])));
					if(mysqli_num_rows($one_enquiry_saw)){
					if($last_date == $current_date){ ?>
						<tr>
							<td><?php echo 1; ?></td>
							<td><?= $see_one_enquiry['customer_name']; ?></td>
							<td style="width: 40%" id="add_view1"><?php  if(strlen($see_one_enquiry['customer_enquiry'])>100){ echo substr($see_one_enquiry['customer_enquiry'],0,100)."...  <a href='javascript:;'  onclick='view_more(".$see_one_enquiry[0].",".$i.")'><i class='fa fa-plus' style='color:blue;'></a></button>";  }else{ echo $see_one_enquiry['customer_enquiry']; } ?></td>
							<td><a id="color-blue" href="mailto:<?= $fetchEnquiry['customer_email']; ?>"><i class="fa fa-envelope-o"></i> Mail Customer</a></td>
							<td><a id="color-blue" href="tel:<?= $see_one_enquiry['customer_contact']; ?>"><i class="fa fa-phone"></i><?= $see_one_enquiry['customer_contact']; ?></a></td>
						</tr>
						<?php } }else{ ?>
						<tr><td colspan="5" style="color: red;text-align: center;font-size: 18px;">* No enquiry listed today</td></tr>
						<?php } ?>
				<tr><td colspan="5" style="color: red;font-weight: bold;text-align: center;font-size: 25px;">* To see your unique customer enquiry, you need to buy a premium business plan </td></tr>
			<?php } } ?>
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
