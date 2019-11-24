<!-- <?php 
if(isset($_GET['type'])){
	$type=$_GET['type'];
	$type=ucwords($type);
}
?> -->
<!-- <?php if(isset($_GET['type'])){ echo $type; } ?> --> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List of property - Quick Siliguri</title>
<?php include'style.php';?>
<body>

<div id="main_wrapper">
<?php include'header.php';?>

<div id="titlebar" class="gradient margin-bottom-0">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>List of property<!-- <?php echo $type;?> --></h2>
<nav id="breadcrumbs">
<ul>
<li><a href="/">Home</a></li>
<li>List of property<!-- <?php echo $type;?> --></li>
</ul>
</nav>
</div>
</div>
</div>
</div>
<!-- Default Time Zone -->
<?php date_default_timezone_set("Asia/Kolkata"); ?>
<!-- End Default Time Zone -->
<div class="container">
<div class="row">

<div class="col-md-12">
<div class="listing_filter_block margin-top-30">
<div class="col-md-3 col-xs-3">
<div class="utf_layout_nav font18 fw-600 text-uppercase amt-10">Filter</div>
</div>
<div class="col-md-9 col-xs-9">
<div class="sort-by utf_panel_dropdown sort_by_margin float-right"> <a href="#">Destination</a>
<div class="utf_panel_dropdown-content">
<input class="distance-radius" type="range" min="1" max="999" step="1" value="1" data-title="Select Range">
<div class="panel-buttons">
<button class="panel-apply">Apply</button>
</div>
</div>
</div>
<div class="sort-by">
<div class="utf_sort_by_select_item sort_by_margin">
<select data-placeholder="Sort by Listing" class="utf_chosen_select_single" style="display: none;">
<option selected="selected">Sort by Listing</option>
<option>Latest Listings</option>
<option>Popular Listings</option>
<option>Price (Low to High)</option>
<option>Price (High to Low)</option>
<option>Highest Reviewe</option>
<option>Lowest Reviewe</option>                  
<option>Newest Listing</option>
<option>Oldest Listing</option>
<option>Random Listings</option>
</select>
</div>
</div>
<div class="sort-by">
<div class="utf_sort_by_select_item sort_by_margin">
<select data-placeholder="Categories:" class="utf_chosen_select_single" style="display: none;">
<option selected="selected">Categories</option>
<option>Restaurant</option>
<option>Health</option>
<option>Hotels</option>
<option>Real Estate</option>                  
<option>Fitness</option>                  
<option>Shopping</option>
<option>Travel</option>
<option>Shops</option>
<option>Nightlife</option>
<option>Events</option>
</select>
</div>
</div>
</div>
</div>

<div class="row">
<?php while($fetchAllProperty = mysqli_fetch_array($selectAllProperty)){
		$select_category = mysqli_query($conn,"SELECT * FROM `category` WHERE id = '".$fetchAllProperty['property_type']."' ");
		$fetch_category = mysqli_fetch_array($select_category);
?>
<div class="col-lg-12 col-md-12">
<div class="utf_listing_item-container list-layout"> <a href="list-detail/<?= $fetchAllProperty['property_name']; ?>/<?= $fetchAllProperty[0].'1b02'.$fetchAllProperty[0]; ?>" class="utf_listing_item">
<div class="utf_listing_item-image"> 
<img src="<?php if($fetchAllProperty['property_image']!=''){ echo "user/uploads/property/".$fetchAllProperty['property_image']; } else{ echo "images/utf_listing_item-01.jpg"; } ?>" alt=""> 
<span class="like-icon"></span> 
<span class="tag"><i class="im im-icon-Hotel"></i> <?= $fetch_category['category_name']; ?></span> 
<span class="featured_tag">Featured</span> 
<div class="utf_listing_prige_block utf_half_list">							
<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; <?php if($fetchAllProperty['property_price']!=''){ echo $fetchAllProperty['property_price']; } else { echo "Price not metioned"; } ?></span>					
<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
</div>
</div>
<?php if((strtotime(date('h:i:sa'))>strtotime($fetchAllProperty['property_open_time'])) && strtotime(date('h:i:sa'))<strtotime($fetchAllProperty['property_close_time'])){ ?>
<span class="utf_open_now">Open Now </span><?php }else{ ?> <span class="utf_closed">Closed Now</span> <?php } ?>

<div class="utf_listing_item_content">
<div class="utf_listing_item-inner">
<h3><!-- <?php  echo date('h:i:sa'); ?> --><?= $fetchAllProperty['property_name']; ?></h3>
<span><i class="sl sl-icon-location"></i> <?= $fetchAllProperty['property_address'] ?></span>
<span><i class="sl sl-icon-phone"></i> <?php if($fetchAllProperty['contact_number']!=''){ echo "+91-".$fetchAllProperty['contact_number']; }else if($fetchAllProperty['alt_contact_no']!=''){ echo "+91-".$fetchAllProperty['alt_contact_no']; }else{ echo "Contact number not metioned"; } ?></span>
<span><i class="fa fa-envelope-o"></i> <?php if($fetchAllProperty['contact_mail']!=''){ echo $fetchAllProperty['contact_mail']; }else{ echo "Mail not metioned"; } ?></span>
<?php $select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$fetchAllProperty[0]."'  ");
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
<p><?php  if(strlen($fetchAllProperty['property_details'])>200){ echo substr($fetchAllProperty['property_details'],0,200)."..."; }else{ echo $fetchAllProperty['property_details']; } ?></p>
</div>
</div>
</a> 
</div>
</div>
<?php } ?>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-12">
<div class="utf_pagination_container_part margin-top-20 margin-bottom-75">
<nav class="pagination">
<ul>
<li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
<li><a href="#" class="current-page">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
</ul>
</nav>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include'footer.php';?>
</body>
</html>