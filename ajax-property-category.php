<?php
require_once "quick-back/db/config.php"; 
extract($_POST);
$sql1 ='';
if(isset($_POST['sort_list'])){
	$sort_list1 = $_POST['sort_list'];
	if($sort_list1 != ''){
		if($sort_list1 == 'latest_list'){
			$sql1 .= " ORDER BY listing_details.id DESC ";
		}
		else if($sort_list1 == 'low_to_high'){
			$sql1 .= " ORDER BY listing_details.property_price ASC";
		}
		else if($sort_list1 == 'high_to_low'){
			$sql1 .= " ORDER BY listing_details.property_price DESC";
		}
	}
}else{
	$sql1 .= " ORDER BY company_reg.prime_id DESC";
}
$select_find_category = mysqli_query($conn,"SELECT * FROM `category` WHERE category_name = '".$_POST['get_cate']."' ");
$fetch_find_category = mysqli_fetch_array($select_find_category);
// full view
$selectAll_Property1 = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` WHERE company_reg.status = 1 AND company_reg.admin_approval = 1 AND listing_details.user_id = company_reg.id AND listing_details.property_type = '".$fetch_find_category['id']."' ' ".$sql1."'  ");
$count_category_list1 = mysqli_num_rows($selectAll_Property1);
$per_page = 25;
$total_pages = ceil($count_category_list1/$per_page);
if(isset($_POST['pages'])){
	$pages = $_POST['pages'];
}else{
	$pages = 1;
}
//pagination view
$selectAll_Property = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `company_reg` WHERE  company_reg.status = 1 AND company_reg.admin_approval = 1 AND listing_details.user_id = company_reg.id AND listing_details.property_type = '".$fetch_find_category['id']."' ".$sql1." LIMIT ".($pages-1)*$per_page.",".$per_page);
$count_category_list = mysqli_num_rows($selectAll_Property);
$errmsg['no_error'] = '';
if($count_category_list>0){
 while($fetchAll_Property = mysqli_fetch_array($selectAll_Property)){
		if($fetchAll_Property['property_image']!=''){ 
			$property_img = "user/uploads/property/".$fetchAll_Property['property_image'];
		} else{ $property_img = "images/utf_listing_item-01.jpg"; }
		if($fetchAll_Property['property_price']!=''){ 
			$p_price =  $fetchAll_Property['property_price']; 
		} else { 
			$p_price =  "Price not metioned"; 
		} 
		if((strtotime(date('h:i:sa'))>strtotime($fetchAll_Property['property_open_time'])) && strtotime(date('h:i:sa'))<strtotime($fetchAll_Property['property_close_time'])){ 
				$opening = '<span class="utf_open_now">Open Now </span>';
			}else{ 
				$opening = '<span class="utf_closed">Closed Now</span>';  
			} 
		if($fetchAll_Property['contact_number']!=''){ 
			$contact_view =  "+91-".$fetchAll_Property['contact_number']; 
		}else if($fetchAll_Property['alt_contact_no']!=''){ 
			$contact_view =  "+91-".$fetchAll_Property['alt_contact_no']; 
		}else{ 
			$contact_view =  "Contact number not metioned"; 
		}
		if($fetchAll_Property['contact_mail']!=''){ 
			$contact_mail = $fetchAll_Property['contact_mail']; 
		}else{ 
			$contact_mail = "Mail not metioned"; 
		} 
		$select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$fetchAll_Property[0]."'  ");
		$sum = 0;
		while($fetch_all_reviews1 =mysqli_fetch_array($select_all_reviews1)){
			$sum = $sum+$fetch_all_reviews1['customer_rating'];
		}
		if(mysqli_num_rows($select_all_reviews1)>0){
			$actual_rating1 = $sum/(mysqli_num_rows($select_all_reviews1));
			$show_star_count = round($actual_rating1,1);
			$int_star = intval($show_star_count);
			$full_star = '';
			for($s=1;$s<=$int_star;$s++){
				$full_star .= '<i class="fa fa-star" id="star-yellow"></i>';
			}
			$h_star = '';
			for($h=1;$h<=(5-$int_star);$h++){
				$h_star.= '<i class="fa fa-star" style="color:gray;"></i>';
			}
		}else{
			$actual_rating1 = 0;
		}
		if(strlen($fetchAll_Property['property_details'])>200){ 
			$property_view =  substr($fetchAll_Property['property_details'],0,200)."..."; 
		}else{ 
			$property_view =  $fetchAll_Property['property_details']; 
		} 

$errmsg['no_error'] .= '<div class="col-lg-12 col-md-12">
<div class="utf_listing_item-container list-layout"> <a href="list-detail/'.$fetchAll_Property['property_name'].'/'.$fetchAll_Property[0].'1b02'.$fetchAll_Property[0].'" class="utf_listing_item">
<div class="utf_listing_item-image"> 
<img src="'.$property_img.'" alt=""> 
<span class="tag"><i class="im im-icon-Hotel"></i>'.$fetch_find_category['category_name'].'</span> 
<span class="featured_tag">Featured</span> 
<div class="utf_listing_prige_block utf_half_list">							
<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; '.$p_price.'</span>					
<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
</div>
</div>
'.$opening.'

<div class="utf_listing_item_content">
<div class="utf_listing_item-inner">
<h3>'.$fetchAll_Property['property_name'].'</h3>
<span><i class="sl sl-icon-location"></i>'.$fetchAll_Property['property_address'].'</span>
<span><i class="sl sl-icon-phone"></i> '.$contact_view.'</span>
<span><i class="fa fa-envelope-o"></i> '.$contact_mail.'</span>

<div class="utf_star_rating_section" data-rating="">'.$full_star.$h_star.'
<div class="utf_counter_star_rating">'.round($actual_rating1,1).'</div></div>
<p>'.$property_view.'</p>
</div>
</div>
</a> 
</div>

</div>';
} 
$page_add = '';
for($i=1;$i<=$total_pages;$i++){ 
 	$page_add .= '<li><a href="javascript:;" class="current-page">'.$i.'</a></li>';
} 
$errmsg['pagination'] = '<div class="col-md-12"><div class="utf_pagination_container_part margin-top-20 margin-bottom-75"><nav class="pagination"><ul>'.$page_add.'</ul></nav></div></div>';
}else{
	$errmsg['main_error'] = '<div class="col-md-4 col-md-offset-4"><div><img src="images/banner/noproduct.png" alt="No Product image"></div></div><div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1"><div class="alert alert-info"><p class="info-alert"><i class="fa fa-empty"></i>'.$_POST['get_cate'].' category has no item</p></div></div>';
}
echo json_encode($errmsg);
?>