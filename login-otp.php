<!-- <?php error_reporting(0); ?> -->
<!DOCTYPE html>
<html lang="en"><head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quick Siliguri - Local Search, Events, Jobs, Shops, Services</title>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<?php include'style.php';?>
<!-- <?php if(isset($_SESSION['otp'])){ echo $_SESSION['otp']; } ?> -->

<style>
.sitebanner{max-height:600px!important;position:relative;}
.section-hero-slider{position:relative;}
.section-hero-slider .hero-slider .hero-slider-image {background-repeat: no-repeat;background-position: center center;background-size: cover;position:relative;
height: 100%;width: 100%;min-height: 600px;}
.section-hero-slider .hero-slider .hero-slider-image::before{content:'';position:absolute;left:0;top:0;width:100%;height:100%;background:rgba(13,115,178,.4);}
.hero-slider-navigation{position:absolute;top:45%;transform:translateY(-50%);width:100%;height:1px;width:100%;}
.hero-slider-navigation .next,.hero-slider-navigation .prev{position:inherit;text-align:center;}
.hero-slider-navigation .next{right:15px;}
.hero-slider-navigation .prev{left:15px;}
.hero-slider-navigation .next span,.hero-slider-navigation .prev span{width:50px;height:50px;line-height:50px;display:inine-block!important;position:inherit; zindex:2;color:#fff;font-size:40px;background:rgba(0,0,0,.2);}
.hero-slider-navigation .next span{right:0;}
.hero-slider-navigation .prev span{left:0;}
.hero-slider-navigation .next span,.hero-slider-navigation .prev span{}
.hero-slider .slick-dots{display:none!Important;}

.hero-slider-container{position:absolute;top:170px;width:100%;}
.hero-slider-container .hero-slider-content{max-width:1100px;margin:0 auto;text-align:center;font-family: 'Nunito', sans-serif;font-weight:700;}
.hero-slider-container .hero-slider-content .hero-slider-title{font-size:64px;color:#fff;text-transform:uppercase;font-weight:700;margin-bottom:15px;}
.hero-slider-container .hero-slider-content p{font-size:26px;color:#fff;text-transform:uppercase;font-wegiht:600;}

/*Satirtha Css*/
#margin25{
    margin-top: 25px;
}
</style>
</head>
<body>

<div id="main_wrapper">
<?php include'header.php';?>
<?php if(isset($_POST['submit_otp'])){
    if($_POST['otp'] == $_SESSION['otp']){
        $insert_query = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE  `company_name` = '".$_SESSION['company_name']."' AND (`contact_number` = '".$_SESSION['contact_no']."' OR  `alt_contact_no` = '".$_SESSION['contact_no']."' )  ");
        $com_reg_id = mysqli_fetch_array($insert_query);
        $_SESSION['company_session_id'] = $com_reg_id['id'];
        echo "<script>window.location.href='user/my-profile.php'</script>";
    } else{
        echo "<script>alert('OTP Does not match')</script>";
    }
} ?>
<div class="container" style="height: 56vh">
    <div class="row">
        
            <div class="alert alert-danger" id="otp_err" style="display: none;">
                <p>OTP doen't matched</p>
            </div>
        
        <div class="col-md-6 col-md-offset-3" id="margin25">
            <?php if(isset($_GET['suc'])){ ?>
                <div class="alert alert-success" id="otp_suc">
                    <p><?= $_GET['suc']; ?></p>
                </div>
            <?php }  ?>
            <h2>OTP Verification</h2>
              <form action="" method="post">
                <div class="form-group">
                  <label for="email">OTP:</label>
                  <input type="text" class="form-control" id="email" placeholder="Enter your otp" name="otp" required="required">
                </div>
                <button type="submit" class="btn btn-info" name="submit_otp">Submit</button>
              </form>
        </div>
    </div>
</div>

<?php include'footer.php';?>
<script type="text/javascript">
    function otpVerify(){
        $("#otp_suc").hide();
        $("#otp_err").show();
    }
</script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
</body>
</html>