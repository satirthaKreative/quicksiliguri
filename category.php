<!-- <?php 
if(isset($_GET['type'])){
	$type=$_GET['type'];
	$type=ucwords($type);
}
?> -->
<!-- <?php if(isset($_GET['type'])){ echo $type; } ?> --> 
<?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array);

    // $list_id = explode('1b02',$page);
    // $actual_id = $list_id[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Businesslist Of <?= $page; ?> - Quick Siliguri</title>
<?php include'style.php';?>
<body>

<div id="main_wrapper">
<?php include'header.php';?>

<div id="titlebar" class="gradient margin-bottom-0">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>List of <?= $page; ?><!-- <?php echo $type;?> --></h2>
<nav id="breadcrumbs">
<ul>
<li><a href="/">Home</a></li>
<li>List of <?= $page; ?><!-- <?php echo $type;?> --></li>
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
<input type="hidden" name="get_cate" id="get_cate" value="<?= $page; ?>">
<div class="listing_filter_block margin-top-30">
<div class="col-md-3 col-xs-3">
<div class="utf_layout_nav font18 fw-600 text-uppercase amt-10">Filter</div>
</div>
<div class="col-md-9 col-xs-9">
<div class="sort-by">
<div class="utf_sort_by_select_item sort_by_margin">
<select data-placeholder="Sort by Listing" class="utf_chosen_select_single" id="sort_list" onchange="change_list();">
<option selected="selected">Sort by Listing</option>
<option value="latest_list">Latest Listings</option>
<option value="low_to_high">Price (Low to High)</option>
<option value="high_to_low">Price (High to Low)</option>
</select>
</div>
</div>
</div>
</div>

<div class="row" id="user_cate_view">

</div>
<div class="clearfix"></div>
</div>
</div>
</div>

<?php include'footer.php';?>
<script type="text/javascript">
	
	var get_cate = $("#get_cate").val();
	
	$.ajax({
		url: 'ajax-property-category',
		type: 'post',
		data: {get_cate:get_cate},
		dataType: 'json',
		success: function(event){
			console.log(event);
			if(event.no_error){
				$("#user_cate_view").empty();
				$("#user_cate_view").append(event.no_error);
				$("#user_cate_view").append(event.pagination);
			}else if(event.main_error){
				$("#user_cate_view").empty();
				$("#user_cate_view").append(event.main_error);
			}
		}
	});

	function change_list(){
		var sort_list = $("#sort_list").val();
		//alert(sort_list);
		$.ajax({
			url: 'ajax-property-category',
			type: 'post',
			data: {sort_list:sort_list,get_cate:get_cate},
			dataType: 'json',
			success: function(event){
				console.log(event);
				if(event.no_error){
					$("#user_cate_view").empty();
					$("#user_cate_view").append(event.no_error);
					$("#user_cate_view").append(event.pagination);
				}else if(event.main_error){
					$("#user_cate_view").empty();
					$("#user_cate_view").append(event.main_error);
				}
			}
		});
	}
</script>
</body>
</html>