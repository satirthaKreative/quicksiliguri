<!DOCTYPE html>
<html lang="en"><head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quick Siliguri - Local Search, Events, Jobs, Shops, Services</title>
<?php include'style.php';?>
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
</style>
</head>
<body>

<div id="main_wrapper">
<?php include'header.php';?>

<div class="sitebanner prelative">
<div class="section-hero-slider">
<div class="hero-slider">
<article class="hero" data-background="light">
<div class="hero-slider-image" style="background-image:url('images/banner/1.jpg')"></div>
<div class="hero-slider-container">
<div class="hero-slider-content">
<h1 class="hero-slider-title" data-animation="animated fadeIn">Quick Siliguri</h1>
<p>Local Search, Hotels, Restaurant, Automobile, Services</p>
</div>
</div>
</article>
</div>
<div class="hero-slider-navigation">
<a href="#" class="next"><span class="fa fa-angle-right" aria-hidden="true"></span></a>
<a href="#" class="prev"><span class="fa fa-angle-left" aria-hidden="true"></span></a>
</div>
</div>


<div class="container main_inner_search_block">
	<!-- search form -->
<form action="search" method="get">
<div class="main_input_search_part">
<div class="main_input_search_part_item">
<input type="text" id="q_name" name="q" placeholder="What are you looking for?" id="q" onkeyup="q_name_change();" />
<div id="q_auto" style="display: none;" >
	
</div>
</div>
<div class="main_input_search_part_item slider_chosen_drop">
<select name="location" data-placeholder="All Locations" class="utf_chosen_select">
	<option value="">Choose Locations</option>
	<?php while($fetch_all_location = mysqli_fetch_array($select_location)){ ?>
		<option value="<?= $fetch_all_location['location_name']; ?>" <?php if($fetch_all_location['location_name'] == 'Siliguri' ){ ?> selected <?php } ?> ><?= $fetch_all_location['location_name']; ?></option>
	<?php } ?>
	
</select>
</div>
<div class="main_input_search_part_item slider_chosen_drop">
<select name="type" data-placeholder="All Categories" class="utf_chosen_select">
<option value="" selected="selected">Choose Category</option>
<?php while($fetch_all_category = mysqli_fetch_array($select_category)){ ?>
	<option value="<?= $fetch_all_category['category_name']; ?>"><?= $fetch_all_category['category_name']; ?></option>
<?php } ?>
</select>
</div>
<button class="button" name="search" type="submit">Search</button>
</div>
</form>

	<!-- end search form -->
</div>
</div>

<!-- <section class="popularcar apt-60 apb-60">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3 class="headline_part centered"> Most Popular Categories</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="container_categories_box margin-top-5 margin-bottom-30"> 
<?php $fetch_all_cate = mysqli_query($conn,"SELECT * FROM `category` limit 10 ");
while($fetch_all = mysqli_fetch_array($fetch_all_cate)){ ?>
<a href="category/<?= $fetch_all['category_name']; ?>" class="utf_category_small_box_part"> <?= $fetch_all['category_icon']; ?>
<h4><?= $fetch_all['category_name']; ?></h4>

<?php 
$select_cate_prod = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE listing_details.property_type = '".$fetch_all['id']."' AND company_reg.admin_approval = 1 AND company_reg.status = 1  ");
$fetch_num_rows = mysqli_num_rows($select_cate_prod); ?>
<span><?= $fetch_num_rows; ?></span>
</a> 
<?php } ?>
</div>
<div class="col-md-12 centered_content"> <a href="search?q=&location=&type=&search=" class="button border margin-top-20">View All Business</a> </div>
</div>
</div>
</div>
</section> -->
<section class="fullwidth_block margin-top-65 margin-bottom-75" data-background-color="#ffffff" style="background: rgb(255, 255, 255);">
	<div class="container">
		<div class="row">
		  <div class="col-md-12">
			<h3 class="headline_part centered margin-bottom-45"> Most Popular Categories</h3>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
			<div class="utf_listing_categorie">
				<?php  $count = 1; $fetch_all_cate = mysqli_query($conn,"SELECT * FROM `category` WHERE id <> 12 AND id <> 23 LIMIT 40 ");
				while($fetch_all = mysqli_fetch_array($fetch_all_cate)){ ?>
				<?php 
				if($count == 1){
					$color_css = "c1";
				}else if($count == 2){
					$color_css = "c2";
				}else if($count == 3){
					$color_css = "c3";
				}else if($count == 4){
					$color_css = "c4";
				}else if($count == 5){
					$color_css = "c5";
				}else if($count == 6){
					$color_css = "c6";
				}else if($count == 7){
					$color_css = "c7";
				}else if($count == 8){
					$color_css = "c8";
				}else if($count == 9){
					$color_css = "c9";
				}else if($count == 10){
					$color_css = "c10";
				}else if($count>10){
					$count = 1;
				}  
				?>
			  <div class="col-xs-12 col-sm-3 col-md-3">
			  	<a href="category/<?= $fetch_all['category_name']; ?>">
				<div class="utf_listing_categorybox  <?= $color_css; ?>" id="main_shw_box">
				  <div class="utf_listing_category_title ">
				    <span class="utf_listing_cateicon icon_bg"><?= $fetch_all['category_icon']; ?></span> 
				    <?php 
				    $select_cate_prodx = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE listing_details.property_type = '".$fetch_all['id']."' AND company_reg.admin_approval = 1 AND company_reg.status = 1  ");
				    $fetch_num_rowsx = mysqli_num_rows($select_cate_prodx); ?>
					<h3 class="head_ccs"><?= ucfirst($fetch_all['category_name']); ?></h3>					
				  </div>
				</div>
				</a>
			  </div>
			  <?php $count++; } ?>
			</div>			
		  </div>
		</div>
	  </div>
  </section>

<section class="fullwidth_block padding-top-60 padding-bottom-60" data-background-color="#f9f9f9">
<div class="container">
<div class="row slick_carousel_slider">
<div class="col-md-12">
<h3 class="headline_part centered margin-bottom-45">Most Newest Listings</h3>
</div>

<div class="row">
<div class="col-md-12">
<div class="simple_slick_carousel_block utf_dots_nav" role="toolbar"> 
<?php 
while($fetchAll_Property = mysqli_fetch_array($selectAllProperty))
{
	$select_category = mysqli_query($conn,"SELECT * FROM `category` WHERE id = '".$fetchAll_Property['property_type']."' ");
	$fetch_category = mysqli_fetch_array($select_category);
?>
<div class="utf_carousel_item">
<a href="list-detail/<?= $fetchAll_Property['property_name']; ?>/<?= $fetchAll_Property[0].'1b02'.$fetchAll_Property[0]; ?>" class="utf_listing_item-container compact" tabindex="0">
<div class="utf_listing_item">
<img src="<?php if($fetchAll_Property['property_image']!=''){ echo "user/uploads/property/".$fetchAll_Property['property_image']; } else{ echo "images/utf_listing_item-01.jpg"; } ?>" alt=""> <span class="tag"> <?= $fetch_category['category_name']; ?></span>
<div class="utf_listing_item_content">
<div class="utf_listing_prige_block">							
<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; <?php if($fetchAll_Property['property_price']!=''){ echo $fetchAll_Property['property_price']; } else { echo "Price not metioned"; } ?></span>							
<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
</div>
<h3><?= $fetchAll_Property['property_name']; ?></h3>
<span><i class="sl sl-icon-location"></i> <?= $fetchAll_Property['property_address']; ?></span>
<span><i class="sl sl-icon-phone"></i> <?php if($fetchAll_Property['contact_number']!=''){ echo "+91-".$fetchAll_Property['contact_number']; }else if($fetchAll_Property['alt_contact_no']!=''){ echo "+91-".$fetchAll_Property['alt_contact_no']; }else{ echo "Contact number not metioned"; } ?></span>												
</div>
</div>
<?php $select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$fetchAll_Property[0]."'  ");
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
<div class="utf_counter_star_rating"><?= round($actual_rating1,1); ?></div>
<!-- <span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span> -->
<!-- <span class="like-icon" onclick="state_like()"></span> -->
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
</section>

<section class="fullwidth_block margin-top-65 margin-bottom-75" data-background-color="#ffffff" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3 class="headline_part centered margin-bottom-45">Recent Places</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="utf_listing_categorie">
<?php
$select_location1 = mysqli_query($conn,"SELECT * FROM `location`  ");
 while($fetch_location1 = mysqli_fetch_array($select_location1)){ ?>
<div class="col-xs-12 col-sm-4 col-md-3">
<a href="search?q=&location=<?= $fetch_location1['location_name']; ?>&type=&search=">
	<div class="utf_listing_categorybox" id="location_id">
	<div class="utf_listing_category_title">
	<div class="col-md-4 col-md-offset-4">
		<span class="utf_listing_cateicon">
			<i class="im im-icon-Hotel"></i>
		</span>
	</div>
	<div class="col-md-12 col-sm-12">
		<h3 class="ml40">
			<?= $fetch_location1['location_name']; ?>	
		</h3>
	</div> 
						
	</div>
	</div>
</a>
</div>
<?php } ?>
</div>			
</div>
</div>
</div>
</section>
<style type="text/css">	
		.ml40{
			margin-left: 40px !important;
		}
		#location_id{
			padding: 60px 30px !important;
		}
		#main_shw_box{
				width: 100% !important;
			    float: left !important;
			    margin: 4px 0 !important;
			    border-radius: 6px !important;

			    border: 1px solid rgba(0,0,0,0.02) !important;
			    padding: 5px 10px !important
		}
		.c1{ background: #1966b6; }
		.c2{ background: #cc4300; }
		.c3{ background: #04724d; }
		.c4{ background: #d80a48; }
		.c5{ background: #762acb; }
		.c6{ background: #097784; }
		.c7{ background: #2531d5; }
		.c8{ background: #931674; }
		.c9{ background: #d52f31; }
		.c10{background: #134b7e; }
		.head_ccs{ color:#fff !important; }
		.icon_bg{background: #fff!important;}
		.icon_bg i{
			color:blue;
		}
</style>
<?php include'footer.php';?>
<script type="text/javascript">
	function q_name_change(){
		var q_name = $("#q_name").val();
		$.ajax({
			url: 'ajax-auto-search',
			type:'post',
			data:{q_name:q_name},
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
					$("#q_auto").show();
					$("#q_auto").empty();
					$("#q_auto").append(event.no_error);
				}else if(event.main_error==1){
					$("#q_auto").hide();
				}
			}
		});
	}
	function q_click(data){
		var auto_click_data = data.value;
		$("#q_name").val(auto_click_data);
		$("#q_auto").hide();
	}
</script>
</body>
</html>