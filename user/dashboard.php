<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Quick Siliguri</title>
<?php include'../style.php';?>
<body>

<div id="main_wrapper">
<?php include'header.php';?>

<div class="clearfix"></div>
<div id="dashboard"> 
<?php include'menu.php';?>
  
<div class="utf_dashboard_content"> 
<div id="titlebar" class="dashboard_gradient">
<div class="row">
<div class="col-md-12 text-left">
<h2>Dashboard</h2>
<nav id="breadcrumbs">
<ul>
<li><a>Home</a></li>
<li>Dashboard</li>
</ul>
</nav>
</div>
</div>
</div>

<!-- <div class="row"> 
<div class="col-lg-2 col-md-6">
<div class="utf_dashboard_stat color-1">
<div class="utf_dashboard_stat_content">
<h4>36</h4>
<span>Published Listings</span>
</div>
<div class="utf_dashboard_stat_icon"><i class="im im-icon-Map2"></i></div>
</div>
</div>

<div class="col-lg-2 col-md-6">
<div class="utf_dashboard_stat color-2">
<div class="utf_dashboard_stat_content">
<h4>615</h4>
<span>Pending Listings</span>
</div>
<div class="utf_dashboard_stat_icon"><i class="im im-icon-Add-UserStar"></i></div>
</div>
</div>

<div class="col-lg-2 col-md-6">
<div class="utf_dashboard_stat color-3">
<div class="utf_dashboard_stat_content">
<h4>9128</h4>
<span>Expired Listings</span>
</div>
<div class="utf_dashboard_stat_icon"><i class="im im-icon-Align-JustifyRight"></i></div>
</div>
</div>

<div class="col-lg-2 col-md-6">
<div class="utf_dashboard_stat color-4">
<div class="utf_dashboard_stat_content">
<h4>572</h4>
<span>New Feedbacks</span>
</div>
<div class="utf_dashboard_stat_icon"><i class="im im-icon-Diploma"></i></div>
</div>
</div>

<div class="col-lg-2 col-md-6">
<div class="utf_dashboard_stat color-5">
<div class="utf_dashboard_stat_content">
<h4>572</h4>
<span>Total Views</span>
</div>
<div class="utf_dashboard_stat_icon"><i class="im im-icon-Eye-Visible"></i></div>
</div>
</div>

<div class="col-lg-2 col-md-6">
<div class="utf_dashboard_stat color-6">
<div class="utf_dashboard_stat_content">
<h4>572</h4>
<span>Total Reviews</span>
</div>
<div class="utf_dashboard_stat_icon"><i class="im im-icon-Star"></i></div>
</div>
</div>
</div> -->

<div class="row"> 
<div class="col-lg-12 col-md-12 mb-4">
<div class="utf_dashboard_list_box table-responsive recent_booking">
<h4>Others Business Enquiry</h4>
<div class="dashboard-list-box table-responsive invoices with-icons">
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
				<th>Posted On</th>
				<th>Mail To </th>
				<th>Call To </th>
				<!-- <th>Property Rating</th> -->
			</thead>
			<tbody>
				<?php $i = 1;
				$selectSessionId = mysqli_query($conn,"SELECT * FROM `category` INNER JOIN `listing_details` ON category.id = listing_details.property_type INNER JOIN `company_reg` ON company_reg.id = listing_details.user_id WHERE company_reg.id = '".$_SESSION['company_session_id']."'  ");
				$fetchSessionId = mysqli_fetch_array($selectSessionId);
				// echo "SELECT * FROM `customer_enquiry` INNER JOIN `company_reg` ON customer_enquiry.company_id = company_reg.id INNER JOIN `listing_details` ON listing_details.user_id = company_reg.id INNER JOIN listing_details.property_type = category.id WHERE company_reg.prime_id = 0 AND listing_details.property_type = '".$fetchSessionId[0]."' ORDER BY customer_enquiry.id DESC";
				if($fetchSessionId['prime_id']!= 0){
					$selectEnquiry = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN `company_reg` ON customer_enquiry.company_id = company_reg.id INNER JOIN `listing_details` ON listing_details.user_id = company_reg.id INNER JOIN `category` ON listing_details.property_type = category.id WHERE company_reg.prime_id = 0 AND listing_details.property_type = '".$fetchSessionId[0]."' ORDER BY customer_enquiry.id DESC");
				}else if($fetchSessionId['prime_id'] == 0){
					$selectEnquiry = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN `company_reg` ON customer_enquiry.company_id = company_reg.id INNER JOIN `listing_details` ON listing_details.user_id = company_reg.id INNER JOIN `category` ON listing_details.property_type = category.id WHERE company_reg.prime_id = 0 AND listing_details.property_type = '".$fetchSessionId[0]."' ORDER BY customer_enquiry.id DESC LIMIT 1 ");
				}
				while($fetchEnquiry = mysqli_fetch_array($selectEnquiry)){ ?>
				
				<tr>
					<td><?= $i; ?></td>
					<td><?= $fetchEnquiry['customer_name']; ?></td>
					<td style="width: 40%" id="add_view<?= $i; ?>"><?php  if(strlen($fetchEnquiry['customer_enquiry'])>100){ echo substr($fetchEnquiry['customer_enquiry'],0,100)."...  <a href='javascript:;'  onclick='view_more(".$fetchEnquiry[0].",".$i.")'><i class='fa fa-plus' style='color:blue;'></a></button>";  }else{ echo $fetchEnquiry['customer_enquiry']; } ?></td>
					<td><?= $fetchEnquiry['added_on']; ?></td>
					<td><a id="color-blue" href="mailto:<?= $fetchEnquiry['customer_email']; ?>"><i class="fa fa-envelope-o"></i> Mail Customer</a></td>
					<td><a id="color-blue" href="tel:<?= $fetchEnquiry['customer_contact']; ?>"><i class="fa fa-phone"></i>Call Customer</a></td>

					<!-- <td><?php for($i=1;$i<$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" id="star-yellow"></i> <?php } for($i=1;$i<5-$fetchEnquiry['customer_rating'];$i++){ ?> <i class="fa fa-star" ></i> <?php } ?></td> -->
				</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
		<!-- Modal -->
		<!-- Modal -->
		
	</div>
	</div>
</div>
</div>
</div>

<?php include'copy.php';?>

</div>
</div>    
</div>  

</div>

<?php include'../scripts.php';?>
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