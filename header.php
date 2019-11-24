<?php debug_backtrace() || header('location:404.php');?>
<?php require_once "quick-back/db/config.php"; ?>
<?php require_once "query/query.php"; ?>
<header id="header_part"> 
<div id="header">
<div class="container"> 
<div class="utf_left_side"> 
<div id="logo"><a href="/"><img src="images/logo.png" alt="Logo"/></a></div>
<!--<div class="nav_responsive"> <i class="fa fa-reorder menu-trigger"></i> </div>
<nav id="navigation" class="style_one hidden">
<ul id="responsive">
<li><a class="current" href="#">Home</a>
<ul>
<li><a href="">Home Version 1</a></li>
<li><a href="">Home Version 2</a></li>
<li><a href="">Home Version 3</a></li>
<li><a href="">Home Version 4</a></li>
<li><a href="">Home Version 5</a></li>
</ul>
</li>			  
<li><a href="#">Listings</a>
<ul>
<li><a href="#">List Layout</a>
<ul>
<li><a href="">Listing List Sidebar</a></li>
<li><a href="">Listing List Full Width</a></li>
</ul>
</li>           
</ul>
</nav>
-->
<div class="clearfix"></div>
</div>
<div class="utf_right_side">
<div class="header_widget">  <?php if(isset($_SESSION['company_session_id'])){ ?><a href="user/logout" class="button border sign-out"><i class="fa fa-sign-out"></i> Logout</a> <?php }else if(isset($_SESSION['front_user_id'])){ ?> <a href="user/logout" class="button border sign-out"><i class="fa fa-sign-out"></i> Logout</a>  <?php }else{ ?> <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim"><i class="fa fa-sign-in"></i> Sign In</a> <?php } ?> <?php if(isset($_SESSION['company_session_id'])){ ?> <a href="user/add-listing" class="button border with-icon"><i class="sl sl-icon-user"></i> Add Listing</a> <?php }else if(isset($_SESSION['front_user_id'])){ ?> <a href="user/my-profile" class="button border with-icon"><i class="sl sl-icon-user"></i> My Profile</a> <?php }else{ ?> <a href="#dialog_signin_part1" class="button border sign-in popup-with-zoom-anim"><i class="fa fa-sign-in"></i> Sign Up</a> <?php } ?> </div>
</div>
<span class="header-call">Contact: <i class="fa fa-phone"></i> <a href="tel:9609620000">9609620000</a></span>
<div id="dialog_signin_part" class="zoom-anim-dialog mfp-hide">
<div class="small_dialog_header">
<h3>Sign In</h3>
</div>
<div class="utf_signin_form style_one">
<ul class="utf_tabs_nav">
<!-- <li class="active"><a href="#tab1">As A Company</a></li>
<li><a href="#tab2">As A User</a></li> -->
</ul>
<div class="tab_container alt"> 
	<div class="tab_content" id="tab1" style="display:none;">
	<form method="post" class="register" id="login_business" action="otp_test">
	<p class="utf_row_form utf_form_wide_block">
	<label for="username2">
	<input type="text" class="input-text" name="comp_name" id="company_name1" placeholder="Business Name" onkeyup="check_company_name1();">
	<p id="check_company_name1"></p>
	</label>
	</p>
	<p class="utf_row_form utf_form_wide_block">
	<label for="password1">
	<input class="input-text" type="number" name="contact_no" id="contact_no1" placeholder="Contact Number" onkeyup="check_contact();">
	<p id="check_company_name2"></p>
	</label>
	</p>
	<p class="login_approval"></p>
	<input type="submit" class="button border fw margin-top-10" name="comp_reg1" id="com_reg1" value="Login">
	<!-- <input type="button" id="back_log" class="button border fw margin-top-10" onclick="login_font_check();" value="Login"> -->
	</form>
	</div>

<!-- <div class="tab_content" id="tab2" style="">
<form method="post" class="login" id="user_login_form">
<p class="utf_row_form utf_form_wide_block">
<label for="username">
<input type="email" class="input-text" name="user_email" id="user_email" placeholder="Usermail" >
</label>
</p>
<p class="utf_row_form utf_form_wide_block">
<label for="password">
<input class="input-text" type="password" name="user_pass" id="user_pass" placeholder="Password">
</label>
</p>
<div class="utf_row_form utf_form_wide_block form_forgot_part"> <span class="lost_password fl_left"> <a href="javascript:void(0);">Forgot Password?</a> </span>
</div>
<div class="utf_row_form">
<input type="button" class="button border margin-top-5" name="login" value="Login" onclick="user_login();">
</div>
<p id="check_company_name5"></p>
</form>
</div> -->

</div>
</div>
</div>
<!-- end first part -->

<div id="dialog_signin_part1" class="zoom-anim-dialog mfp-hide">
<div class="small_dialog_header">
<h3>Sign Up</h3>
</div>
<div class="utf_signin_form style_one">
<ul class="utf_tabs_nav">
<!-- <li class="active"><a href="#tab3">As A Company</a></li>
<li><a href="#tab4">As A User</a></li> -->
</ul>
<div class="tab_container alt">
	<div class="tab_content" id="tab3" style="display:none;">
	<form method="post" class="register" action="otp_test">
	<p class="utf_row_form utf_form_wide_block">
	<label for="username2">
	<input type="text" class="input-text" name="comp_name" id="company_name" placeholder="Business Name" >
	<p id="check_company_name" style="color: red;"></p>
	</label>
	</p>
	<p class="utf_row_form utf_form_wide_block">
	<label for="email2">
	<input type="text" class="input-text" name="contact_name" id="contact_name" placeholder="Contact Person">
	</label>
	</p>
	<p class="utf_row_form utf_form_wide_block">
	<label for="password1">
	<input class="input-text" type="number" name="contact_no" id="contact_no" placeholder="Contact Number" onkeyup="check_company_name();">
	</label>
	</p>
	<!-- <p class="utf_row_form utf_form_wide_block">
	<label for="password2">
	<input class="input-text" type="password" name="password2" id="password2" placeholder="Confirm Password">
	</label>
	</p> -->
	<input type="submit" class="button border fw margin-top-10" name="comp_reg" id="com_reg" value="Register">
	</form>
	</div> 
<div class="tab_content" id="tab4" style="">
<form method="post" class="login" id="user_reg_form">
<p class="utf_row_form utf_form_wide_block">
<label for="username">
<input type="email" class="input-text" name="usermail" id="usermail" placeholder="Mail Address">
</label>
</p>
<p class="utf_row_form utf_form_wide_block">
<label for="password">
<input type="password" class="input-text" name="password" id="password" placeholder="Password">
</label>
</p>
<p class="utf_row_form utf_form_wide_block">
<label for="cpassword">
<input class="input-text" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
</label>
</p>

<div class="utf_row_form">
<input type="button" class="button border margin-top-5" name="user_reg" value="Register" onclick="user_registration()">
</div>
<p id="check_company_name4"></p>
</form>
</div>


</div>
</div>
</div>
<!-- second part -->
<div id="dialog_signin_part2" class="zoom-anim-dialog mfp-hide">
<div class="small_dialog_header">
<h3>Enquiry Now</h3>
</div>
<div class="utf_signin_form style_one">
<div class="tab_container alt"> 
<div class="tab_content" id="tab3" style="">
<!-- <form id="enquiryForm1">
<p class="utf_row_form utf_form_wide_block">
<label for="username">
<input type="hidden" name="listing_id" value="<?= $enq; ?>">
<input type="hidden" name="user_id" value="<?php if(isset($_SESSION['front_user_id'])){ echo $_SESSION['front_user_id']; } ?>"> 
<input class="input-text form_empty" name="name" type="text" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_name']; } ?>" placeholder="Name" required="">   
</label>
</p>
<p class="utf_row_form utf_form_wide_block">
<label for="password">
<input class="input-text form_empty" name="email" type="email" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_email']; } ?>" placeholder="Email" required=""> 
</label>
</p>
<p class="utf_row_form utf_form_wide_block">
<label for="cpassword">
<input class="input-text form_empty" name="phone" type="text" value="<?php if(isset($_SESSION['front_user_id'])){ echo $fetch_logged_customer['user_contact']; } ?>" placeholder="Phone" required="">  
</label>
</p>
<p class="utf_row_form utf_form_wide_block">
<label for="cpassword">
<textarea class="input-text form_empty" name="comments" cols="40" rows="2" id="comments" placeholder="Your Message" required=""></textarea>  
</label>
</p>

<div class="utf_row_form">
<input type="button" class="button border margin-top-5" name="user_reg" value="Register" onclick="user_registration()"> -->
<!-- <input type="button" class="submit button" id="send_enquiry" onclick="send_query1();" value="Send Enquiry">
</div>
<p class="succEnquiry"></p>
</form>  -->
</div>
</div>
</div>
</div>

</div>
</div>

</header>
<div class="clearfix"></div>
