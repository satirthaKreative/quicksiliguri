<?php 
if(isset($_GET['type']) && $_GET['type']!=''){
$type=$_GET['type'];
$type=ucwords($type);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List of <?php if(isset($_GET['type']) && $_GET['type']!=''){ echo $type; }else{ echo "Business"; } ?> - Quick Siliguri</title>
<style type="text/css">	
	.suc_alert{
		padding: 30px 0px !important;
		margin: 10px 0 !important;
		text-align: center !important;
		background: lightblue !important;
		border-radius: 10px !important;
		color: #101082 !important;
	}
</style>
<?php include'style.php';?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<body>

<div id="main_wrapper">
<?php include'header.php';?>

<div id="titlebar" class="gradient margin-bottom-0">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>List of <?php if(isset($_GET['type']) && $_GET['type']!=''){ echo $type; }else{ echo "Business"; } ?></h2>
<nav id="breadcrumbs">
<ul>
<li><a href="/">Home</a></li>
<li>List of <?php if(isset($_GET['type']) && $_GET['type']!=''){ echo $type; }else{ echo "Business"; } ?></li>
</ul>
</nav>
</div>
</div>
</div>
</div>

<div class="container">
<div class="row">
<div class="col-md-12">
<div class="listing_filter_block margin-top-30">
<div class="col-md-3 col-xs-3">
<div class="utf_layout_nav font18 fw-600 text-uppercase amt-10">Filter</div>
</div>
<div class="col-md-9 col-xs-9">
	<input type="hidden" value="<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>" id="prop_get_type">
	<input type="hidden" value="<?php if(isset($_GET['q'])){ echo $_GET['q']; } ?>" id="prop_get_q">
	<input type="hidden" value="<?php if(isset($_GET['location'])){ echo $_GET['location']; } ?>" id="prop_get_location">
<!-- <div class="sort-by utf_panel_dropdown sort_by_margin float-right"> <a href="#">Destination</a>
<div class="utf_panel_dropdown-content">
<input class="distance-radius" type="range" min="1" max="999" step="1" value="1" data-title="Select Range">
<div class="panel-buttons">
<button class="panel-apply">Apply</button>
</div>
</div>
</div> -->
<div class="sort-by">
<div class="utf_sort_by_select_item sort_by_margin">
<select data-placeholder="Sort by Listing" class="utf_chosen_select_single" name="sort_list" id="sort_list" onchange="change_list();">
<option selected="selected">Sort by Listing</option>
<option value="latest_list">Latest Listings</option>
<option value="low_to_high">Price (Low to High)</option>
<option value="high_to_low">Price (High to Low)</option>
<!-- <option value="high_reviews">Highest Reviewe</option>
<option value="low_reviews">Lowest Reviewe</option> -->                  
</select>
</div>
</div>
<div class="sort-by">
<div class="utf_sort_by_select_item sort_by_margin">
<select data-placeholder="Categories:" name="type" id="prop_type" onchange="change_type()" class="utf_chosen_select_single">
<option value="" selected="selected">Categories</option>
<?php while($fetch_category = mysqli_fetch_array($select_category)){ ?>
<option value="<?= $fetch_category['category_name']; ?>"><?= $fetch_category['category_name']; ?></option>
<?php } ?>
</select>
</div>
</div>
</div>
</div>

<div class="row" id="user_cate_view">
	<?php 
	// select pages 
	$sql = "SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE company_reg.admin_approval = 1 AND  company_reg.status = 1 AND category.category_name  like '%".mysqli_real_escape_string($conn,$_GET['type'])."%' AND listing_details.property_address  like '%".mysqli_real_escape_string($conn,$_GET['location'])."%' AND (listing_details.property_details  like '%".mysqli_real_escape_string($conn,$_GET['q'])."%' OR listing_details.property_price  like '%".mysqli_real_escape_string($conn,$_GET['q'])."%' OR listing_details.property_name like '%".mysqli_real_escape_string($conn,$_GET['q'])."%' ) ORDER BY company_reg.prime_id DESC  ";
	$total_result = mysqli_num_rows(mysqli_query($conn,$sql));
	$show_in_page = 25;
	$total_pages = ceil($total_result/$show_in_page);
	if(isset($_GET['pages'])){
		$pages = $_GET['pages'];
	}else{
		$pages = 1; 
	}
	$search_listing = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE  company_reg.admin_approval = 1  AND  company_reg.status = 1  AND category.category_name  like '%".mysqli_real_escape_string($conn,$_GET['type'])."%' AND listing_details.property_address  like '%".mysqli_real_escape_string($conn,$_GET['location'])."%' AND (listing_details.property_details  like '%".mysqli_real_escape_string($conn,$_GET['q'])."%' OR listing_details.property_price  like '%".mysqli_real_escape_string($conn,$_GET['q'])."%' OR listing_details.property_name like '%".mysqli_real_escape_string($conn,$_GET['q'])."%' ) ORDER BY company_reg.prime_id DESC LIMIT ".($pages-1)*$show_in_page.",".$show_in_page);
		// $total_result = mysqli_num_rows($search_listing);
		
		if($total_result>0){
		while($fetch_listing = mysqli_fetch_array($search_listing)){
	?>
<div class="col-lg-12 col-md-12">
<div class="utf_listing_item-container list-layout"> 
	<a href="list-detail/<?= $fetch_listing['property_name']; ?>/<?= $fetch_listing[0].'1b02'.$fetch_listing[0]; ?>" class="utf_listing_item">
<div class="utf_listing_item-image"> 
<img src="<?php if($fetch_listing['property_image']!=''){ echo "user/uploads/property/".$fetch_listing['property_image']; } else{ echo "images/utf_listing_item-01.jpg"; } ?>" alt=""> 
<!-- <span class="like-icon"></span>  -->
<span class="tag"><i class="im im-icon-<?= $fetch_listing['category_icon'] ?>"></i> <?= $fetch_listing['category_name']; ?></span> 
<span class="featured_tag">Featured</span> 
<div class="utf_listing_prige_block utf_half_list">							
<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; <?php if($fetch_listing['property_price']!=''){ echo $fetch_listing['property_price']; } else { echo "Price not metioned"; } ?></span>					
<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
</div>
</div>
<?php if((strtotime(date('h:i:sa'))>strtotime($fetch_listing['property_open_time'])) && strtotime(date('h:i:sa'))<strtotime($fetch_listing['property_close_time'])){ ?>
<span class="utf_open_now">Open Now </span><?php }else{ ?> <span class="utf_closed">Closed Now</span> <?php } ?>
<div class="utf_listing_item_content">
<div class="utf_listing_item-inner">
<h3><?= $fetch_listing['property_name']; ?></h3>
<span><i class="sl sl-icon-location"></i> <?= $fetch_listing['property_address']; ?> </span> 
<span><i class="sl sl-icon-phone"></i> <?php if($fetch_listing['contact_number']!=''){ echo "+91-".$fetch_listing['contact_number']; }else if($fetch_listing['alt_contact_no']!=''){ echo "+91-".$fetch_listing['alt_contact_no']; }else{ echo "Contact number not metioned"; } ?></span>
<?php $select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$fetch_listing[0]."'  ");
		$sum = 0;
		while($fetch_all_reviews1 =mysqli_fetch_array($select_all_reviews1)){
			$sum = $sum+$fetch_all_reviews1['customer_rating'];
		}
		if(mysqli_num_rows($select_all_reviews1)>0){
			$actual_rating1 = $sum/(mysqli_num_rows($select_all_reviews1));
		}else{
			$actual_rating1 = 0;
		}
?>
<div class="utf_star_rating_section" data-rating="<?= round($actual_rating1,1); ?>">
<div class="utf_counter_star_rating"><?= round($actual_rating1,1); ?></div>
<!-- <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span> --></div>
<!-- <div class="utf_star_rating_section" data-rating="4.5">
<div class="utf_counter_star_rating">(4.5)</div>
<span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span></div> -->
<p><?php  if(strlen($fetch_listing['property_details'])>200){ echo substr($fetch_listing['property_details'],0,200)."..."; }else{ echo $fetch_listing['property_details']; } ?> <button href="javascript:;" class="button popup-with-zoom-anim" style="float: right;" onclick="tezt(<?= $fetch_listing[0]; ?>)">Enquiry Now</button><!-- <button href="#dialog_signin_part2" class="button sign-in popup-with-zoom-anim" style="float: right;">Enquiry Now  </button> --></p>
</div>
</div>
</a> 
</div>
</div>
<?php } }else{ ?><div class="col-md-12"><div class="suc_alert"><i class="fa fa-times"></i> <b>No Data Available</b></div></div>
<?php } ?>
</div>
<div class="clearfix"></div>
<?php if($total_result>0){ ?>
<div class="row" id="pagination_id">
<div class="col-md-12">
<div class="utf_pagination_container_part margin-top-20 margin-bottom-75">
<nav class="pagination">
<ul>
<?php for($i=1;$i<=$total_pages;$i++){ ?>
<!-- <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li> -->
<li><a href="search?q=<?= $_GET['q'] ?>&location=<?= $_GET['location'] ?>&type=<?= $_GET['type'] ?>&pages=<?= $i; ?>" <?php if($pages==$i){ ?> class="current-page" <?php } ?>><?= $i; ?></a></li>
<!-- <li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li> -->
<!-- <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li> -->
<?php } ?>
</ul>
</nav>
</div>
</div>
</div>
<?php } ?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enquiry Form</h4>
        </div>
        <div class="modal-body">
        <form id="enquiryForm1">
        	<input type="hidden" name="listing_id" id="prop_id" value="">
        	<input type="hidden" name="user_id" value="<?php if(isset($_SESSION['front_user_id'])){ echo $_SESSION['front_user_id']; } ?>"> 
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_email']; } ?>">
          </div>
          <!-- <div class="form-group">
            <label for="pwd">Username:</label> -->
            <input type="hidden" class="form-control" name="name" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_name']; } ?>" id="pwd">
          <!-- </div> -->
          <div class="form-group">
            <label for="pwd">Phone:</label>
            <input type="text" class="form-control" name="phone" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_contact']; } ?>" id="pwd">
          </div>
          <div class="form-group">
            <label for="pwd">Your Enquiry:</label>
            <textarea type="text" class="form-control" name="comments"  id="pwd"></textarea>
          </div>
          <button type="button" id="send_enquiry" onclick="send_query1();" class="btn btn-info btn-lg">Enquiry Now</button>
          <p class="succEnquiry"></p>
        </div>

        </form>
      </div>
      
    </div>
  </div>

</div>
</div>
</div>

<?php include'footer.php';?>
<script type="text/javascript">
	function send_query1(){
		$.ajax({
			url: 'ajax-enquiry',
			type: 'post',
			data: $("#enquiryForm1").serialize(),
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
				    $(".succEnquiry").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
				    $(".form_empty").val('');
				    setTimeout(function() {
				    	$("#myModal").modal('hide');
				      }, 1000);
				}else if(event.main_error){
				    $(".succEnquiry").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
				}
			}
		})
	}
	function check_enquiry(){
		return false;
	}
	function change_list(){
		var type = $("#prop_type").val();
		var sort_list = $("#sort_list").val();
		var get_type = $("#prop_get_type").val();
		var get_q = $("#prop_get_q").val();
		var get_location = $("#prop_get_location").val();
		$.ajax({
			url: 'ajax-property-chage',
			type: 'post',
			data: {type:type,sort_list:sort_list,get_type:get_type,get_q:get_q,get_location:get_location},
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
					$("#pagination_id").empty();
					$("#user_cate_view").empty();
					$("#user_cate_view").append(event.no_error);
				}else if(event.main_error){
					$("#pagination_id").empty();
					$("#user_cate_view").empty();
					$("#user_cate_view").append(event.main_error);
				}
			}
		});
	}
	function change_type(){
		var sort_list = $("#sort_list").val();
		var type = $("#prop_type").val();
		var get_type = $("#prop_get_type").val();
		var get_q = $("#prop_get_q").val();
		var get_location = $("#prop_get_location").val();
		$.ajax({
			url: 'ajax-property-chage',
			type: 'post',
			data: {type:type,sort_list:sort_list,get_type:get_type,get_q:get_q,get_location:get_location},
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
					$("#pagination_id").empty();
					$("#user_cate_view").empty();
					$("#user_cate_view").append(event.no_error);
				}else if(event.main_error){
					$("#pagination_id").empty();
					$("#user_cate_view").empty();
					$("#user_cate_view").append(event.main_error);
				}
			}
		});
	}
	function tezt(data){
		$("#prop_id").val(data);
		$("#myModal").modal('show');
	}

</script>
</body>
</html>