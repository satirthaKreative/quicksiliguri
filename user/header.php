<?php require_once "../quick-back/db/config.php"; ?>
<?php if(isset($_SESSION['company_session_id'])){

}else if(isset($_SESSION['front_user_id'])){

}else{
	echo "<script>window.location.href=''</script>";
}  ?>
<!-- <?php if((!isset($_SESSION['company_session_id']) ) && (!isset($_SESSION['front_user_id']))){ echo "<script>window.location.href=''</script>"; } ?> -->
<?php if(isset($_SESSION['front_user_id'])){ 
	$select_header_name = mysqli_query($conn,"SELECT * FROM `customer_tbl` WHERE id = '".$_SESSION['front_user_id']."' ");
	$fetch_header_name = mysqli_fetch_array($select_header_name);
}else if(isset($_SESSION['company_session_id'])){ 
	$select_header_name = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE id = '".$_SESSION['company_session_id']."' ");
	$fetch_header_name = mysqli_fetch_array($select_header_name); 
} ?>
<header id="header_part" class="fixed fullwidth_block dashboard"> 
<div id="header" class="not-sticky">
<div class="container"> 
<div class="utf_left_side"> 
<div id="logo"> <a><img src="images/logo.png" alt=""></a>
<a href="" class="dashboard-logo"><img src="images/logo-admin.png" alt=""></a> </div>
</div>

<div class="utf_right_side"> 
<div class="header_widget"> 
<div class="dashboard_header_button_item has-noti js-item-menu" id="backcolor">
<!-- <i class="sl sl-icon-bell"></i> -->
<div class="dashboard_notifi_dropdown js-dropdown">
<div class="dashboard_notifi_title">
<p>You Have 2 Notifications</p>
</div>
<div class="dashboard_notifi_item">
<div class="bg-c1 red">
<i class="fa fa-check"></i>
</div>
<div class="content">
<p>Your Listing <b>Burger House (MG Road)</b> Has Been Approved!</p>
<span class="date">2 hours ago</span>
</div>
</div>
<div class="dashboard_notifi_item">
<div class="bg-c1 green">
<i class="fa fa-envelope"></i>
</div>
<div class="content">
<p>You Have 7 Unread Messages</p>
<span class="date">5 hours ago</span>
</div>
</div>
<div class="dashboard_notify_bottom text-center pad-tb-20">
<a href="#">View All Notification</a>
</div>
</div>
</div>
<div class="utf_user_menu">
<div class="utf_user_name"><span><img src="<?php if(isset($_SESSION['company_session_id']) || isset($_SESSION['front_user_id'])){ if(($fetch_header_name['user_image']!='' )|| ($fetch_header_name['user_image']!=0)){ echo "user/uploads/".$fetch_header_name['user_image']; }else{ echo 'images/user-avatar.jpg'; } } ?>" alt="Avatar"/></span>Hi,<?php if(isset($_SESSION['company_session_id'])){ echo $fetch_header_name['company_name']; }elseif(isset($_SESSION['front_user_id'])){ if($fetch_header_name['user_name'] !=''){ echo $fetch_header_name['user_name']; }else{ echo "User"; } } ?> </div>
<ul>
<li><a href="user/dashboard"><i class="sl sl-icon-layers"></i> Dashboard</a></li>
<!-- <li><a href="user/my-profile"><i class="sl sl-icon-user"></i> My Profile</a></li>
<li><a href="user/my-listing"><i class="sl sl-icon-list"></i> My Listing</a></li> -->
<li><a href="user/logout"><i class="sl sl-icon-power"></i> Logout</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</header>
