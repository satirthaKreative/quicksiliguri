<a href="#" class="utf_dashboard_nav_responsive"><i class="fa fa-reorder"></i> Dashboard Sidebar Menu</a>
<div class="utf_dashboard_navigation">
<div class="utf_dashboard_navigation_inner_block">
<ul>
<li class="active"><a href="user/dashboard"><i class="sl sl-icon-layers"></i> Dashboard</a></li> 
<?php if(isset($_SESSION['company_session_id'])){ ?> 
<?php $select_show_data = mysqli_query($conn,"SELECT * FROM `listing_details` WHERE user_id = '".$_SESSION['company_session_id']."'  ");
	$count_avail_data = mysqli_num_rows($select_show_data); ?>  
		<li>
			<a href="user/add-listing"><i class="sl sl-icon-plus"></i>Business</a>
		</li>	         
<!-- <li><a href="user/view-listing"><i class="sl sl-icon-list"></i> My Listings</a>
</li> -->	
<?php } ?>	  		 
<!-- <li><a href="javascript:;"><i class="sl sl-icon-docs"></i> Bookings</a></li> -->
<?php if(isset($_SESSION['company_session_id'])){ ?>		  
<li><a href="user/enquiry.php"><i class="sl sl-icon-envelope-open"></i> Enquiry</a></li>
<?php } else if($_SESSION['front_user_id']){ ?>
<li><a href="user/my-enquiry.php"><i class="sl sl-icon-wallet"></i> My Enquiry</a></li>
<?php } ?>	
<?php if(isset($_SESSION['company_session_id'])){ ?>	            
<li>
<a href="user/reviews"><i class="sl sl-icon-star"></i> Reviews</a>
</li>
<?php } ?>
<!-- <li><a href="user/my-profile"><i class="sl sl-icon-user"></i> My Profile</a></li>
<li><a href="user/change-password"><i class="sl sl-icon-key"></i> Change Password</a></li> -->
<li><a href="user/logout"><i class="sl sl-icon-power"></i> Logout</a></li>
</ul>
</div>
</div>  