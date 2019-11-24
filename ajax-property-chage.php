<?php 
require_once "quick-back/db/config.php"; 
extract($_POST);
$type = $_POST['type'];
$sql = "SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN `company_reg` ON listing_details.user_id = company_reg.id WHERE   company_reg.status = 1 AND company_reg.admin_approval = 1 AND category.category_name  like '%".mysqli_real_escape_string($conn,$type)."%' AND company_reg.status = 1 ";
if($_POST['get_location'] !=''){
	$sql .= " AND listing_details.property_address like '%".mysqli_real_escape_string($conn,$_POST['get_location'])."%' ";
}
if($sort_list != ''){
	if($sort_list == 'latest_list'){
		$sql .= " ORDER BY listing_details.id DESC ";
	}
	else if($sort_list == 'low_to_high'){
		$sql .= " ORDER BY listing_details.property_price ASC";
	}
	else if($sort_list == 'high_to_low'){
		$sql .= " ORDER BY listing_details.property_price DESC";
	}
	else{
		$sql .= " ORDER BY company_reg.prime_id DESC";
	}

}
$errmsg['no_error'] = '';
$sql1 = $sql;
$query_view1 = mysqli_query($conn,$sql1);
if(mysqli_num_rows($query_view1)>0){
	while($fetch_view = mysqli_fetch_array($query_view1)){
		if($fetch_view['property_image']!=''){ 
			$product_image = "user/uploads/property/".$fetch_view['property_image']; 
		} else{
			$product_image = "images/utf_listing_item-01.jpg";
		}
		if($fetch_view['property_price']!=''){ 
			$p_price = $fetch_view['property_price']; 
		} else { 
			$p_price = "Price not metioned";
		} 
		if((strtotime(date('h:i:sa'))>strtotime($fetch_view['property_open_time'])) && strtotime(date('h:i:sa'))<strtotime($fetch_view['property_close_time'])){ 
			$open_not = '<span class="utf_open_now">Open Now </span>';
		}else{
			$open_not = '<span class="utf_closed">Closed Now</span>';
		}
		$select_all_reviews1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$fetch_view[0]."'  ");
		$sum = 0;
		while($fetch_all_reviews1 =mysqli_fetch_array($select_all_reviews1)){
			$sum = $sum+$fetch_all_reviews1['customer_rating'];
		}if(mysqli_num_rows($select_all_reviews1)>0){
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
		if($fetch_view['contact_number']!=''){ 
			$contact_number = "+91-".$fetch_view['contact_number']; 
		}else if($fetch_view['alt_contact_no']!=''){ 
			$contact_number = " +91-".$fetch_view['alt_contact_no']; 
		}else{ 
			$contact_number = "Contact number not metioned";
		}
		if(strlen($fetch_view['property_details'])>200){ 
			$property_del = substr($fetch_view['property_details'],0,200)."..."; 
		}else{ 
			$property_del = $fetch_view['property_details']; 
		}


$errmsg['no_error'] .= '<div class="col-lg-12 col-md-12"><div class="utf_listing_item-container list-layout"> <a href="list-detail/'. $fetch_view['property_name'].'/'.$fetch_view[0].'1b02'.$fetch_view[0].'" class="utf_listing_item"><div class="utf_listing_item-image"> <img src="'.$product_image.'" alt=""> <span class="like-icon"></span> <span class="tag"><i class="im im-icon-'.$fetch_view['category_icon'].'"></i> '.$fetch_view['category_name'].'</span> <span class="featured_tag">Featured</span> <div class="utf_listing_prige_block utf_half_list">	<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> &#x20b9; '.$p_price.'</span>	<span class="utp_approve_item"><i class="utf_approve_listing"></i></span></div></div>'.$open_not.'<div class="utf_listing_item_content"><div class="utf_listing_item-inner"><h3>'.$fetch_view['property_name'].'</h3><span><i class="sl sl-icon-location"></i>'.$fetch_view['property_address'].'</span><span><i class="sl sl-icon-phone"></i> '.$contact_number.'</span><div class="utf_star_rating_section" data-rating="'.round($actual_rating1,1).'">'.$full_star.''.$h_star.'<div class="utf_counter_star_rating">'.round($actual_rating1,1).'</div></div><p>'.$property_del.'</p></div></div></a> </div></div>';
	}
} else{
	$errmsg['main_error'] = '<div class="col-md-12"><div class="suc_alert"><i class="fa fa-times"></i> <b>No Data Available</b></div></div>';
}
echo json_encode($errmsg);
?>