<?php debug_backtrace() || header('location:404.php');?>
<!-- Footer -->
<div id="footer" class="footer_sticky_part"> 
<div class="container">
<!--
<div class="row">
<div class="col-md-2 col-sm-3 col-xs-6">
<h4>Useful Links</h4>
<ul class="social_footer_link">
<li><a href="#">Home</a></li>
<li><a href="#">Listing</a></li>
<li><a href="#">Blog</a></li>
<li><a href="#">Privacy Policy</a></li>
<li><a href="#">Contact</a></li>
</ul>
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4>My Account</h4>
<ul class="social_footer_link">
<li><a href="#">Dashboard</a></li>
<li><a href="#">Profile</a></li>
<li><a href="#">My Listing</a></li>
<li><a href="#">Favorites</a></li>
</ul>
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4>Pages</h4>
<ul class="social_footer_link">
<li><a href="#">Blog</a></li>
<li><a href="#">Our Partners</a></li>
<li><a href="#">How It Work</a></li>
<li><a href="#">Privacy Policy</a></li>
</ul>
</div>
<div class="col-md-2 col-sm-3 col-xs-6">
<h4>Help</h4>
<ul class="social_footer_link">
<li><a href="#">Sign In</a></li>
<li><a href="#">Register</a></li>
<li><a href="#">Add Listing</a></li>
<li><a href="#">Pricing</a></li>
<li><a href="#">Contact Us</a></li>
</ul>
</div>
<div class="col-md-4 col-sm-12 col-xs-12"> 
<h4>About Us</h4>
<p class="colord">Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor sit amet, 
consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>          
</div>
</div>

-->

<div class="text-center">
<img src="images/logo-white.png" alt="Logo" class="max"/>
</div>

<div class="footer_copyright_part">
<div class="row">
<div class="col-md-6 text-center-xs">
<div class="white">Copyright &copy; Quick Siliguri, <?php echo date('Y');?>. All Rights Reserved.</div>
</div>
<div class="col-md-6">
<div class="dblock text-right text-center-xs"><span class="tagger"><a href="https://www.cyberhelpindia.com/" target="_blank" rel="nofollow"><img src="images/tag1.png" alt="Cyber Help India" title="Cyber Help India"/></a></span></div>
</div>

</div>
</div>
</div>
</div>  
<div id="bottom_backto_top" class=""><a href="#"></a></div>
</div>

<!-- Scripts --> 
<script src="js/jquery2-and-all.js"></script>
<script src="js/jquery_custom.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function check_company_name(){
		var com_id = $("#company_name").val();
		var contact_no = $("#contact_no").val();
		$.ajax({
		  url: 'ajax-check-company',
		  type: 'post',
		  data: {com_id:com_id,contact_no:contact_no},
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#check_company_name").html("<b style='color:red'>"+event.no_error+"</b>").fadeIn().delay(100).fadeOut('slow');
		      $("#com_reg").attr("disabled", "disabled");
		    }else if(event.validation){ 
		    	$("#check_company_name").html("<b style='color:red'>"+event.validation+"</b>").fadeIn().delay(100).fadeOut('slow');
		    	$("#com_reg").attr("disabled", "disabled");
		    }else if(event.main_error){
		      $("#com_reg").removeAttr("disabled", "disabled");
		    }
		  }
		})

	}
	function check_company_name1(){
		var com_id = $("#company_name1").val();
		$.ajax({
		  url: 'ajax-check-company-login',
		  type: 'post',
		  data: {com_id:com_id},
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#check_company_name1").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
		      $("#com_reg1").removeAttr("disabled", "disabled");
		    }else if(event.main_error){
		      $("#check_company_name1").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
		      $("#com_reg1").attr("disabled", "disabled");
		    }
		  }
		})

	}

	function check_contact(){
		var com_id = $("#company_name1").val();
		var phn_id = $("#contact_no1").val();
		$.ajax({
		  url: 'ajax-check-phone-login',
		  type: 'post',
		  data: {com_id:com_id,phn_id:phn_id},
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#check_company_name2").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(500).fadeOut('slow');
		      $("#com_reg1").removeAttr("disabled", "disabled");
		      $('#com_reg1').prop('disabled', false);
		    }else if(event.main_error){
		      $("#check_company_name2").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(500).fadeOut('slow');
		      $("#com_reg1").attr("disabled", "disabled");
		    }
		  }
		})
	}
	function user_registration(){
		//alert('suucess');
		$.ajax({
		  url: 'ajax-user-reg',
		  type: 'post',
		  data: $("#user_reg_form").serialize(),
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#check_company_name4").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		      // $("#com_reg1").removeAttr("disabled", "disabled");
		    }else if(event.main_error){
		      $("#check_company_name4").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		      // $("#com_reg1").attr("disabled", "disabled");
		    }
		  }
		})
	}

	function user_login(){
		$.ajax({
		  url: 'ajax-user-login',
		  type: 'post',
		  data: $("#user_login_form").serialize(),
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $("#check_company_name5").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		      // $("#com_reg1").removeAttr("disabled", "disabled");
		      window.setTimeout(function() {
		          window.location.href = 'user/my-profile';
		      }, 5000);
		    }else if(event.main_error){
		      $("#check_company_name5").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		      // $("#com_reg1").attr("disabled", "disabled");
		    }
		  }
		})
	}
	$(function(){
		$('#com_reg1').prop('disabled', true);
		$('#com_reg').prop('disabled', true);
	})
	// $(function(){
	// 	$("#com_reg1").hide();
	// })
	// function login_font_check(){
	// 	$.ajax({
	// 		url: 'ajax-admin-log-check',
	// 		type: 'post',
	// 		data: $("#login_business").serialize(),
	// 		dataType: 'json',
	// 		success: function(event){
	// 			console.log(event);
	// 			if(event.no_error==0){

	// 			}else if(event.main_error==1){

	// 			}
	// 		}
	// 	})
	// }
</script>
