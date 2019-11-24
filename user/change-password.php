<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password - Quick Siliguri</title>
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
<div class="col-md-12">
<h2>Change Password</h2>
<nav id="breadcrumbs">
<ul>
<li><a href="user/dashboard">Dashboard</a></li>
<li>Change Password</li>
</ul>
</nav>
</div>
</div>
</div>
<div class="row"> 
<div class="col-lg-12 col-md-12">
<div class="utf_dashboard_list_box margin-top-0">
<h4 class="gray"><i class="sl sl-icon-key"></i> Change Password</h4>
<div class="utf_dashboard_list_box-static"> 
<?php if(isset($_SESSION['company_session_id'])){ ?>
<form id="change_pass">
	<div class="my-profile">
	<div class="row with-forms">
		<input type="hidden" name="profile_id" value="<?php if(isset($_SESSION['company_session_id'])){ echo $_SESSION['company_session_id']; } ?>">
	<div class="col-md-4">
	<label>Current Password</label>						
	<input type="password" class="input-text form_cate" name="c_pass" placeholder="*********" value="<?php if(isset($_POST['c_pass'])){ echo $_POST['c_pass']; } ?>">
	</div>
	<div class="col-md-4">
	<label>New Password</label>						
	<input type="password" class="input-text form_cate" name="n_pass" placeholder="*********" value="<?php if(isset($_POST['n_pass'])){ echo $_POST['n_pass']; } ?>">
	</div>
	<div class="col-md-4">
	<label>Confirm New Password</label>
	<input type="password" class="input-text form_cate" name="cn_pass" placeholder="*********" value="<?php if(isset($_POST['cn_pass'])){ echo $_POST['cn_pass']; } ?>">
	</div>
	<div class="col-md-12">
	<button type="button" class="button btn_center_item margin-top-15" name="change_pass" onclick="change_password()">Change Password</button>
	</div>
	</div>
	</div>
</form>
<?php } else if(isset($_SESSION['front_user_id'])){ ?>
	<form id="change_pass">
		<div class="my-profile">
		<div class="row with-forms">
			<input type="hidden" name="profile_id" value="<?php if(isset($_SESSION['front_user_id'])){ echo $_SESSION['front_user_id']; } ?>">
		<div class="col-md-4">
		<label>Current Password</label>						
		<input type="password" class="input-text form_cate" name="c_pass" placeholder="*********" value="<?php if(isset($_POST['c_pass'])){ echo $_POST['c_pass']; } ?>">
		</div>
		<div class="col-md-4">
		<label>New Password</label>						
		<input type="password" class="input-text form_cate" name="n_pass" placeholder="*********" value="<?php if(isset($_POST['n_pass'])){ echo $_POST['n_pass']; } ?>">
		</div>
		<div class="col-md-4">
		<label>Confirm New Password</label>
		<input type="password" class="input-text form_cate" name="cn_pass" placeholder="*********" value="<?php if(isset($_POST['cn_pass'])){ echo $_POST['cn_pass']; } ?>">
		</div>
		<div class="col-md-12">
		<button type="button" class="button btn_center_item margin-top-15" name="change_pass" onclick="change_pass_user()">Change Password</button>
		</div>
		</div>
		</div>
	</form>
<?php } ?>
<div class="sucmsg" style="display: none;text-align: center;"></div>
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
	function change_password(){
		
		$.ajax({
		  url: 'user/ajax-change-pass',
		  type: 'post',
		  data: $("#change_pass").serialize(),
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		      $(".form_cate").val('');
		    }else if(event.main_error){
		      $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		    }
		  }
		});
	}

	function change_pass_user(){
		$.ajax({
		  url: 'user/ajax-change-pass-user',
		  type: 'post',
		  data: $("#change_pass").serialize(),
		  dataType: 'json',
		  success: function(event){
		  	console.log(event);
		    if(event.no_error){
		      $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		      $(".form_cate").val('');
		    }else if(event.main_error){
		      $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
		    }
		  }
		});
	}
</script>
</body>
</html>