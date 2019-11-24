<?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array);

    $list_id = explode('1b02',$page);
    $actual_id = $list_id[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $link_array[2] ?> - Quick Siliguri</title>
<?php include'style.php';?>
<body>

<div id="main_wrapper">
<?php include'header.php';?>
<!-- Fetch List -->
<?php $selectList = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE listing_details.id = '".$actual_id."' AND company_reg.admin_approval = 1 ");
		$fetchListDetails = mysqli_fetch_array($selectList); 
	// multiple image upload
	$multiple_image = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `property_images` ON listing_details.id = property_images.property_id WHERE property_images.property_id = '".$actual_id."' ");
?>
<!-- Fetch Category -->
<?php $selectCategory = mysqli_query($conn,"SELECT * FROM `category` WHERE id = '".$fetchListDetails['property_type']."' ");
$fetchCategory = mysqli_fetch_array($selectCategory);

?>
<div class="clearfix"></div>
<div id="utf_listing_gallery_part" class="utf_listing_section">
<div class="utf_listing_slider utf_gallery_container margin-bottom-0">
<input type="hidden" id="actual_id" name="actual_id" value="<?= $actual_id; ?>">
<?php if(mysqli_num_rows($multiple_image) < 1){ ?>
<?php for($c=0;$c<=7;$c++){ ?>
	<a href="<?= 'user/uploads/property/'.$fetchListDetails['property_image']; ?>" data-background-image="user/uploads/property/<?= $fetchListDetails['property_image']; ?>" class="item utf_gallery"></a>
<?php } ?>
<?php }else{ ?>
<a href="<?= 'user/uploads/property/'.$fetchListDetails['property_image']; ?>" data-background-image="user/uploads/property/<?= $fetchListDetails['property_image']; ?>" class="item utf_gallery"></a>
<?php while($fetchMulti = mysqli_fetch_array($multiple_image)){ ?>
<a href="<?= 'user/uploads/property/other_property/'.$fetchMulti['property_images']; ?>" data-background-image="user/uploads/property/other_property/<?= $fetchMulti['property_images']; ?>" class="item utf_gallery"></a>
<?php } } ?>
</div> 
</div>

<div class="container">
	<input type="hidden" name="full_url" id="full_url" value="<?= $link; ?>">
<div class="row utf_sticky_main_wrapper">
<div class="col-lg-8 col-md-8">
<div id="titlebar" class="utf_listing_titlebar">
<div class="utf_listing_titlebar_title">
<h2><?= $fetchListDetails['property_name']; ?> <span class="listing-tag"><?= $fetchCategory['category_name']; ?></span></h2>		   
<span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> <?php if($fetchListDetails['property_address']!=''){ echo $fetchListDetails['property_address']; }else{ echo $fetchListDetails['map_links']; } ?></a> </span>			
<span class="call_now"><i class="sl sl-icon-phone"></i> <?php if($fetchListDetails['contact_number']!=''){ echo "+91-".$fetchListDetails['contact_number']; }else if($fetchListDetails['alt_contact_no']!=''){ echo "+91-".$fetchListDetails['alt_contact_no']; }else{ echo "Contact number not metioned"; } ?></span>
<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; <?php if($fetchListDetails['property_price']!=''){ echo $fetchListDetails['property_price']; } else { echo "Price not metioned"; } ?></span>
<!-- Customer Reviews -->
<?php $select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$actual_id."'  ");
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
<div class="utf_star_rating_section" id="main_rate_img" data-rating="<?= $actual_rating1; ?>">
<div class="utf_counter_star_rating" id="total_rate_view"></div>
</div>			
</div>
</div>

<div id="utf_listing_overview" class="utf_listing_section">
<h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Business Description</h3>
<p><?= $fetchListDetails['property_details']; ?></p>
<div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">          
<a href="#"><i class="sl sl-icon-phone" aria-hidden="true"></i> <?php if($fetchListDetails['contact_number']!=''){ echo "+91-".$fetchListDetails['contact_number']; }else if($fetchListDetails['alt_contact_no']!=''){ echo "+91-".$fetchListDetails['alt_contact_no']; }else{ echo "Contact number not metioned"; } ?></a>			
<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php if($fetchListDetails['contact_mail']!=''){ echo $fetchListDetails['contact_mail']; }else{ echo "Mail not metioned"; } ?></a>	
<!-- <a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> www.example.com</a>	 -->		
</div>
<!-- <div class="social-contact">
<a href="#" class="facebook-link"><i class="fa fa-facebook"></i> Facebook</a>
<a href="#" class="twitter-link"><i class="fa fa-twitter"></i> Twitter</a>
<a href="#" class="instagram-link"><i class="fa fa-instagram"></i> Instagram</a>
<a href="#" class="linkedin-link"><i class="fa fa-linkedin"></i> Linkedin</a>
<a href="#" class="youtube-link"><i class="fa fa-youtube-play"></i> Youtube</a>
</div>	 -->	  		 
</div>

<!-- <div id="utf_listing_tags" class="utf_listing_section listing_tags_section">
<h3 class="utf_listing_headline_part margin-top-30 margin-bottom-40">Listings Tags</h3>
<a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Food</a>
<a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Fruits</a>
<a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Lunch</a>
<a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Menu</a>
<a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Parking</a>
<a href="#"><i class="fa fa-tag" aria-hidden="true"></i> Restaurant</a>
</div> -->

<!-- <div class="utf_listing_section">
<h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Pricing</h3>
<div class="show-more">
<div class="utf_pricing_list_section">
<h4>Menu Listing</h4>
<ul>
<li>
<h5>Burger <sub class="ppl-offer label-light-success">20% Off</sub></h5>
<p>Beef, Salad, Mayonnaise, Spicey Relish, Cheese</p>
<span>$120</span> 
</li>
<li>
<h5>Goat Cheese Mousse</h5>
<p>Caramelized Fig, Plums, Macadamia Nuts and Sorrel</p>
<span>$150</span> 
</li>
<li>
<h5>Pizza <sub class="ppl-offer label-light-success">10% Off</sub></h5>
<p>Cheddar Cheese, Lettuce, Tomato, Onion, Dill Pickles</p>
<span>$130</span> 
</li>
<li>
<h5>French Crostini <sub class="ppl-offer label-light-success">10% Off</sub></h5>
<p>Breakfast Sandwich on a Roll with 2 Eggs</p>
<span>$130</span> 
</li>
<li>
<h5>Caramelised Rum Punch <sub class="ppl-offer label-light-success">15% Off</sub></h5>
<p>Caramelised Mount Gay Eclipse with a Picked Watermelon</p>
<span>$120</span> 
</li>		
<li>
<h5><strong>Tatel Price</strong></h5>
<span><strong>$650</strong></span> 
</li>
</ul>
</div>
</div>
<a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-double-down"></i></a> 
</div> -->

<!-- <div id="utf_listing_amenities" class="utf_listing_section">
<h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Features</h3>
<ul class="utf_listing_features checkboxes margin-top-0">
<li>Air Conditioned</li>
<li>Swimming Pool</li>
<li>Room Service</li>
<li>Luxury Bedding</li>
<li>Free Wifi</li>
<li>Bath Towel</li>
<li>Wireless Internet</li>
<li>Free Parking on premises</li>
<li>Free Parking on Street</li>
<li>Live Music</li>            
<li>Indoor Pool</li>            
</ul>
</div> -->

<!-- <div id="utf_listing_faq" class="utf_listing_section">
<h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Listing FAQ's</h3>
<div class="style-2">
<div class="accordion">
<h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all"><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (1) How to Open an Account?</h3>
<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
<p>Lorem Ipsum is simply dummy text of the printing and type setting
industry. Lorem Ipsum is simply dummy text of the printing and type 
setting industry.</p>
</div>
<h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all"><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (2) How to Add Listing?</h3>
<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
<p>Lorem Ipsum is simply dummy text of the printing and type setting
industry. Lorem Ipsum is simply dummy text of the printing and type 
setting industry.</p>
</div>
<h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all"><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (3) What is Featured Listing?</h3>
<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-utf_widget_content" style="display: none;">
<p>Lorem Ipsum is simply dummy text of the printing and type setting
industry. Lorem Ipsum is simply dummy text of the printing and type 
setting industry.</p>
</div>			  			  				  			  
</div>
</div>
</div> -->

<!-- <div id="utf_listing_location" class="utf_listing_section">
<h3 class="utf_listing_headline_part margin-top-60 margin-bottom-40">Location</h3>

</div> -->
<div id="utf_listing_reviews" class="utf_listing_section">
<h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Reviews <span id="review_count_val"></span></h3>
<div class="clearfix"></div>
<div class="comments utf_listing_reviews">
<ul id="review_add">

</ul>
</div>

<div class="clearfix"></div>
<!-- <div class="row">
<div class="col-md-12">
<div class="utf_pagination_container_part margin-top-30">
<nav class="pagination">
<ul>
<li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
<li><a href="#" class="current-page">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
</ul>
</nav>
</div>
</div>
</div> -->
<div class="clearfix"></div>
</div>
<?php if(!isset($_SESSION['company_session_id'])){ ?>
<div id="utf_add_review" class="utf_add_review-box">
<h3 class="utf_listing_headline_part margin-bottom-20">Add Your Review</h3>
<span class="utf_leave_rating_title">Your email address will not be published.</span>
<form id="utf_add_comment" class="utf_add_comment">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="clearfix"></div>
<div class="utf_leave_rating margin-bottom-30">
<input type="radio" name="user_rating" id="rating-1" value="5" >
<label for="rating-1" class="fa fa-star"></label>
<input type="radio" name="user_rating" id="rating-2" value="4">
<label for="rating-2" class="fa fa-star"></label>
<input type="radio" name="user_rating" id="rating-3" value="3">
<label for="rating-3" class="fa fa-star"></label>
<input type="radio" name="user_rating" id="rating-4" value="2">
<label for="rating-4" class="fa fa-star"></label>
<input type="radio" name="user_rating" id="rating-5" value="1" checked="checked">
<label for="rating-5" class="fa fa-star"></label>
</div>
<div class="clearfix"></div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
<!-- upload photo -->
<?php if(!isset($_SESSION['front_user_id'])){ ?>
<!-- <div class="add-review-photos margin-bottom-30">
<div class="photoUpload"> <span>Upload Photo <i class="sl sl-icon-arrow-up-circle"></i></span>
<input type="file" class="upload" name="files">
</div>
</div> -->
<?php } ?>
<!-- end upload photo -->
</div>
</div>

<fieldset>
<div class="row">
	<input type="hidden" name="property_id" value="<?= $actual_id; ?>">
	<input type="hidden" name="customer_id" value="<?php if(isset($_SESSION['front_user_id'])){ echo $_SESSION['front_user_id']; } ?>">
<div class="col-md-4">
<label>Name:</label>
<input type="text" placeholder="Name"  name="user_name" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_name']; } ?>">
</div>
<div class="col-md-4">
<label>Email:</label>
<input type="text" placeholder="Email"  name="user_email" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_email']; } ?>">
</div>
<div class="col-md-4">
<label>Subject:</label>
<input type="text" placeholder="Subject" class="form_empty" name="user_subject" value="">
</div>
</div>
<div>
<label>Review:</label>
<textarea cols="40" name="user_reviews" class="form_empty" placeholder="Your Message..." rows="3"></textarea>
</div>
</fieldset>
<button type="button" name="submit_review" onclick="review_send()" class="submit button">Submit Review</button>
<p class="succReview"></p>
<div class="clearfix"></div>
</form>
</div>
<?php } ?>
</div>

<!-- Sidebar -->
<div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
<div class="verified-badge with-tip margin-bottom-30" data-tip-content="Listing has been verified and belongs business owner or manager."> <i class="sl sl-icon-check"></i> Now Available<div class="tip-content">Listing has been verified and belongs business owner or manager.</div></div>

<div class="utf_box_widget opening-hours ">
<h3><i class="sl sl-icon-envelope-open"></i> Enquiry Form</h3>
<form id="enquiryForm" >
<div class="row"> 
<input type="hidden" name="listing_id" value="<?= $actual_id; ?>">
<input type="hidden" name="user_id" value="<?php if(isset($_SESSION['front_user_id'])){ echo $_SESSION['front_user_id']; } ?>">             
<div class="col-md-12">                
<input class="form_empty" name="name" type="text" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_name']; } ?>" placeholder="Name">                
</div>
<div class="col-md-12">                
<input class="form_empty" name="email" type="email" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_email']; } ?>" placeholder="Email" required="">                
</div>    
<div class="col-md-12">                
<input class="form_empty" name="phone" type="text" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_contact']; } ?>" placeholder="Phone" required="">                
</div>	
<div class="col-md-12">
<textarea class="form_empty" name="comments" cols="40" rows="2" id="comments" placeholder="Your Message" required=""></textarea>
</div>
</div>            
<input type="button" class="submit button" id="send_enquiry" onclick="send_query();" value="Send Enquiry">
<p class="succEnquiry"></p>
</form>
</div>

<div class="utf_box_widget margin-top-35">
<h3><i class="sl sl-icon-folder-alt"></i> Categories</h3>
<ul class="utf_listing_detail_sidebar">
<?php while($fetchAllCategory = mysqli_fetch_array($selectAllCategory)){ ?>
<li><i class="fa fa-angle-double-right"></i> <a href="category/<?= $fetchAllCategory['category_name']; ?>"><?= $fetchAllCategory['category_name']; ?></a></li>
<?php } ?>
</ul>
</div>
<?php if($fetchCategory['category_name']=='Hotel' || $fetchCategory['category_name']=='Restaurant'){ ?>
<!-- <div class="utf_box_widget booking_widget_box margin-top-35">
<h3><i class="fa fa-calendar"></i> Booking</h3>
<div class="row with-forms margin-top-0">
<div class="col-lg-12 col-md-12">
<input type="text" id="date-picker" placeholder="Select Date" readonly="readonly" value="09/09/2019">
</div>
<div class="col-lg-12">
<div class="panel-dropdown time-slots-dropdown">
<a href="#">Choose Time Slot...</a>
<div class="panel-dropdown-content padding-reset">
<div class="panel-dropdown-scrollable">
<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-1">
<label for="time-slot-1"><strong><span>1</span> : 8:00 AM - 8:30 AM</strong></label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-2">
<label for="time-slot-2">
<strong><span>2</span> : 8:30 AM - 9:00 AM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-3">
<label for="time-slot-3">
<strong><span>3</span> : 9:00 AM - 9:30 AM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-4">
<label for="time-slot-4">
<strong><span>4</span> : 9:30 AM - 10:00 AM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-5">
<label for="time-slot-5">
<strong><span>5</span> : 10:00 AM - 10:30 AM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-6">
<label for="time-slot-6">
<strong><span>6</span> : 13:00 PM - 13:30 PM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-7">
<label for="time-slot-7">
<strong><span>7</span> : 13:30 PM - 14:00 PM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-8">
<label for="time-slot-8">
<strong><span>8</span> : 14:00 PM - 14:30 PM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-9">
<label for="time-slot-9">
<strong><span>9</span> : 15:00 PM - 15:30 PM</strong>
</label>
</div>

<div class="time-slot">
<input type="radio" name="time-slot" id="time-slot-10">
<label for="time-slot-10">
<strong><span>10</span> : 16:00 PM - 16:30 PM</strong>
</label>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel-dropdown">
<a href="#">Guests <span class="qtyTotal" name="qtyTotal">2</span></a>
<div class="panel-dropdown-content">
<div class="qtyButtons">
<div class="qtyTitle">Adults</div>
<input type="text" name="qtyInput" value="1">
</div>
<div class="qtyButtons">
<div class="qtyTitle">Childrens</div>
<input type="text" name="qtyInput" value="1">
</div>
</div>
</div>
</div>
</div>          
<button class="utf_progress_button button fullwidth_block margin-top-5" type="submit">Request Booking<div class="progress-bar"></div></button>
<div class="clearfix"></div>
</div> -->
<?php }else{} ?>
<!-- contact -->
<!-- <div class="utf_box_widget margin-top-35">
<h3><i class="sl sl-icon-phone"></i> Contact Info</h3>
<div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="U-Listing%20Directory%20-%20Listing%20HTML%20Template_files/dashboard-avatar.jpg" alt=""></a>
<h4><a href="#">Kathy Brown</a><span>Posted 3 Days Ago</span>
<span><i class="sl sl-icon-location"></i> Lonsdale St, Melbourne</span>
</h4>
</div>
<ul class="utf_social_icon rounded margin-top-10">
<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
<li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
</ul>
<ul class="utf_listing_detail_sidebar">
<li><i class="sl sl-icon-map"></i> 12345 Little Lonsdale St, Melbourne</li>
<li><i class="sl sl-icon-phone"></i> +(012) 1123-254-456</li>
<li><i class="sl sl-icon-globe"></i> <a href="#">www.example.com</a></li>
<li><i class="fa fa-envelope-o"></i> <a href="mailto:info@example.com">info@example.com</a></li>
</ul>		  
</div> -->

<!-- <div class="utf_box_widget opening-hours margin-top-35">
<h3><i class="sl sl-icon-clock"></i> Business Hours</h3>
<ul>
<li>Monday <span>09:00 AM - 09:00 PM</span></li>
<li>Tuesday <span>09:00 AM - 09:00 PM</span></li>
<li>Wednesday <span>09:00 AM - 09:00 PM</span></li>
<li>Thursday <span>09:00 AM - 09:00 PM</span></li>
<li>Friday <span>09:00 AM - 09:00 PM</span></li>
<li>Saturday <span>09:00 AM - 10:00 PM</span></li>
<li>Sunday <span>09:00 AM - 10:00 PM</span></li>
</ul>
</div> -->	
<!-- <div class="opening-hours margin-top-35">
<div class="utf_coupon_widget" style="background-image: url(images/coupon-bg-1.jpg);">
<div class="utf_coupon_overlay"></div>
<a href="#" class="utf_coupon_top">
<h3>Book Now &amp; Get 50% Discount</h3>
<div class="utf_coupon_expires_date">Date of Expires 05/08/2019</div>	
<div class="utf_coupon_used"><strong>How to use?</strong> Just show us this coupon on a screen</div>	
</a>
<div class="utf_coupon_bottom">
<p>Coupon Code</p>
<div class="utf_coupon_code">DL76T</div>
</div>
</div>
</div> -->
<!-- <div class="utf_box_widget opening-hours margin-top-35">
<h3><i class="sl sl-icon-info"></i> Additional Information</h3>
<ul>
<li>Take Out: <span>Yes</span></li>
<li>Delivery: <span>Yes</span></li>
<li>Neutral Restrooms: <span>Yes</span></li>
<li>Has Pool Table: <span>Yes</span></li>
<li>Gender Neutral Restrooms: <span>Yes</span></li>
<li>Waiter Service: <span>Yes</span></li>
</ul>
</div> -->

<div class="utf_box_widget opening-hours margin-top-35">
<h3><i class="sl sl-icon-info"></i> Map Location</h3>
<?php if($fetchListDetails['map_links'] != ''){ ?>
<iframe width="300" height="240" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $fetchListDetails['map_links']; ?>&output=embed"></iframe>
<?php }else{ ?>
	<b id="color-blue">Map details not attached yet</b>
<?php } ?>
</div>


<div class="utf_box_widget opening-hours margin-top-35">
<h3><i class="sl sl-icon-info"></i> Advertize</h3>
<span><img src="U-Listing%20Directory%20-%20Listing%20HTML%20Template_files/google_adsense.jpg" alt=""></span>
<?php 
$select_ad = mysqli_query($conn,"SELECT * FROM `advertize` ORDER BY rand() limit 1 ");
while($fetch_ad = mysqli_fetch_array($select_ad)){ ?>
<?php if($fetch_ad['p_image']!=''){?> <img src="quick-back/uploads/promotional/images/<?= $fetch_ad['p_image']; ?>" height="300" width="300" alt="image show"> <?php } else if($fetch_ad['p_video']!=''){ ?> <iframe width="300" height="300" src="<?= $fetch_ad['p_video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> <?php } ?>
<?php }	?>
</div>
<!-- <div class="utf_box_widget margin-top-35">
<h3><i class="sl sl-icon-phone"></i> Quick Contact to Help?</h3>
<p>Excepteur sint occaecat non proident, sunt in culpa officia deserunt mollit anim id est laborum.</p>
<ul class="utf_social_icon rounded">
<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
<li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
</ul>
<a class="utf_progress_button button fullwidth_block margin-top-5" href="http://utouchdesign.com/themes/ulisting_html/ulisting_ltr/contact.html">Contact Us<div class="progress-bar"></div></a> 
</div> -->
<!-- <div class="utf_box_widget listing-share margin-top-35 margin-bottom-40 no-border">
<h3><i class="sl sl-icon-pin"></i> Bookmark Listing</h3>
<span>1275 People Bookmarked Listings</span>
<button class="like-button"><span class="like-icon"></span> Login to Bookmark Listing</button>          
<ul class="utf_social_icon rounded margin-top-35">
<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
<li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
</ul>
<div class="clearfix"></div>
</div> -->
<!-- <div class="utf_box_widget opening-hours review-avg-wrapper margin-top-35">
<h3><i class="sl sl-icon-star"></i>  Rating Average </h3>
<div class="box-inner">
<div class="rating-avg-wrapper text-theme clearfix">
<div class="rating-avg">4.8</div>
<div class="rating-after">
<div class="rating-mode">/5 Average</div>

</div>
</div>
<div class="ratings-avg-wrapper">
<div class="ratings-avg-item">
<div class="rating-label">Quality</div>
<div class="rating-value text-theme">5.0</div>
</div>
<div class="ratings-avg-item">
<div class="rating-label">Location</div>
<div class="rating-value text-theme">4.5</div>
</div>
<div class="ratings-avg-item">
<div class="rating-label">Space</div>
<div class="rating-value text-theme">3.5</div>
</div>
<div class="ratings-avg-item">
<div class="rating-label">Service</div>
<div class="rating-value text-theme">4.0</div>
</div>
<div class="ratings-avg-item">
<div class="rating-label">Price</div>
<div class="rating-value text-theme">5.0</div>
</div>
</div>
</div>
</div> -->
</div>
</div>
</div>

<section class="fullwidth_block padding-top-20 padding-bottom-50">
<?php 
//echo "SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id WHERE listing_details.property_type = '".$fetchListDetails['property_type']."' AND listing_details.id <> '".$actual_id."' ";
$select_property_by_category = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE company_reg.admin_approval = 1 AND listing_details.property_type = '".$fetchListDetails['property_type']."' AND listing_details.id <> '".$actual_id."' ");
	$count_prop_cate_id = mysqli_num_rows($select_property_by_category);
	if($count_prop_cate_id > 0){ ?>
<div class="container">
<div class="row slick_carousel_slider">
<div class="col-md-12">
<h3 class="headline_part centered margin-bottom-25">Similar Listings</h3>

</div>		
<div class="row">
<div class="col-md-12">
<div class="simple_slick_carousel_block utf_dots_nav"> 
<?php 

	
	while($fetch_property_by_category = mysqli_fetch_array($select_property_by_category)){
?>
<div class="utf_carousel_item" data-slick-index="-3" aria-hidden="true">
<a href="list-detail/<?= $fetch_property_by_category['property_name']; ?>/<?= $fetch_property_by_category[0].'1b02'.$fetch_property_by_category[0]; ?>" class="utf_listing_item-container compact">
<div class="utf_listing_item">
<img src="<?php if($fetch_property_by_category['property_image']!=''){ echo "user/uploads/property/".$fetch_property_by_category['property_image']; } else{ echo "images/utf_listing_item-01.jpg"; } ?>" alt=""> <span class="tag"><?= $fetch_property_by_category['category_name']; ?></span>
<div class="utf_listing_item_content">
<div class="utf_listing_prige_block">							
<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; <?php if($fetch_property_by_category['property_price']!=''){ echo $fetch_property_by_category['property_price']; } else { echo "Price not metioned"; } ?></span>							
<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
</div>
<h3><?= $fetch_property_by_category['property_name']; ?></h3>
<span><i class="sl sl-icon-location"></i> <?= $fetch_property_by_category['property_name']; ?></span>
<span><i class="sl sl-icon-phone"></i> <?php if($fetch_property_by_category['contact_number']!=''){ echo "+91-".$fetch_property_by_category['contact_number']; }else if($fetch_property_by_category['alt_contact_no']!=''){ echo "+91-".$fetch_property_by_category['alt_contact_no']; }else{ echo "Contact number not metioned"; } ?></span>												
</div>
</div>
<?php $select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$fetch_property_by_category[0]."'  ");
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
<div class="utf_star_rating_section" data-rating="<?= $actual_rating1; ?>">
<div class="utf_counter_star_rating">(<?= round($actual_rating1,1); ?>)</div>
<!-- <span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span> -->
<span class="like-icon"></span>
</div>
</a> 
</div>
<?php 
}
?>

</div>
</div>


</div>
</div>
</div>
<?php } ?>
</div>
</div>
</section>
</div>

<?php include'footer.php';?>
<script type="text/javascript">
	load_review();
	function send_query(){
		$.ajax({
			url: 'ajax-enquiry',
			type: 'post',
			data: $("#enquiryForm").serialize(),
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
				    $(".succEnquiry").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
				    $(".form_empty").val('');
				}else if(event.main_error){
				    $(".succEnquiry").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
				}
			}
		})
	}

	function review_send(){
		$.ajax({
			url: 'ajax-review',
			type: 'post',
			data: $("#utf_add_comment").serialize(),
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
				    $(".succReview").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
				    $(".form_empty").val('');
				    window.setTimeout(function() {
				        load_review();
				    }, 5000);
				}else if(event.main_error){
				    $(".succReview").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
				}
			}
		})
	}
	function load_review(){
		var actual_id = $('#actual_id').val();
		$.ajax({
			url: 'ajax-review-view',
			type: 'post',
			data: {actual_id:actual_id},
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error !=''){
					$("#review_add").empty();
				    $("#review_add").append(event.no_error);
				    $("#review_count_val").empty();
				    $("#review_count_val").append(event.count_review);
				    $("#total_rate_view").empty();
				    $("#total_rate_view").append(event.total_rate_view);
				 
				}else if(event.main_error !=''){
					$("#review_add").empty();
				    $("#review_add").append(event.main_error);
				    $("#review_count_val").empty();
				    $("#review_count_val").append(event.count_review);
				 
				}
			}
		})
	}

</script>
<script src="js/quantityButtons.js"></script>
<script src="js/moment.js"></script>
<script src="js/daterangepicker.js"></script>
<script>
$(function() {
$('#date-picker').daterangepicker({
"opens": "left",
singleDatePicker: true,
isInvalidDate: function(date) {
var disabled_start = moment('09/02/2018', 'MM/DD/YYYY');
var disabled_end = moment('09/06/2018', 'MM/DD/YYYY');
return date.isAfter(disabled_start) && date.isBefore(disabled_end);
}
});
});

$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
$('.daterangepicker').addClass('calendar-visible');
$('.daterangepicker').removeClass('calendar-hidden');
});
$('#date-picker').on('hide.daterangepicker', function(ev, picker) {
$('.daterangepicker').removeClass('calendar-visible');
$('.daterangepicker').addClass('calendar-hidden');
});

function close_panel_dropdown() {
$('.panel-dropdown').removeClass("active");
$('.fs-inner-container.content').removeClass("faded-out");
}
$('.panel-dropdown a').on('click', function(e) {
if ($(this).parent().is(".active")) {
close_panel_dropdown();
} else {
close_panel_dropdown();
$(this).parent().addClass('active');
$('.fs-inner-container.content').addClass("faded-out");
}
e.preventDefault();
});
$('.panel-buttons button').on('click', function(e) {
$('.panel-dropdown').removeClass('active');
$('.fs-inner-container.content').removeClass("faded-out");
});
var mouse_is_inside = false;
$('.panel-dropdown').hover(function() {
mouse_is_inside = true;
}, function() {
mouse_is_inside = false;
});
$("body").mouseup(function() {
if (!mouse_is_inside) close_panel_dropdown();
});
</script>

</body>
</html>