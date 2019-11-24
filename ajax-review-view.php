<?php require_once "quick-back/db/config.php"; ?>
<?php 
extract($_POST); 
$select_all_reviews = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$_POST['actual_id']."'  ");
$sum = 0;
while($fetch_all_reviews =mysqli_fetch_array($select_all_reviews)){
	$sum = $sum+$fetch_all_reviews['customer_rating'];
}
if(mysqli_num_rows($select_all_reviews)>0){
	$actual_rating = $sum/(mysqli_num_rows($select_all_reviews));
}else{
	$actual_rating = 0;
}

$select_reviews = mysqli_query($conn,"SELECT * FROM `customer_reviews` WHERE property_id = '".$_POST['actual_id']."' ORDER BY id DESC LIMIT 5 ");
$error_msg['no_error'] = '';
$error_msg['main_error'] = '';
$error_msg['count_review'] = '('.mysqli_num_rows($select_all_reviews).')';
$error_msg['tot_ac_rate'] = intval($actual_rating);
$error_msg['total_rate_view'] = '('.round($actual_rating,1).' '.'/'.' '.mysqli_num_rows($select_all_reviews) .' Reviews )';
if(mysqli_num_rows($select_reviews)>0){
while($fetch_reviews = mysqli_fetch_array($select_reviews)){
	$originalDate = $fetch_reviews['review_posted_on'];
	$newDate = date("M d,Y H:i a", strtotime($originalDate));
		$error_msg['no_error'] .= '<li><div class="avatar"><img src="images/dashboard-avatar.png" alt=""></div><div class="utf_comment_content"><div class="utf_arrow_comment"></div><div class="utf_star_rating_section" data-rating="'.$fetch_reviews['customer_rating'].'"></div>
			<div class="utf_by_comment">'.$fetch_reviews['customer_name'].'<span class="date"><i class="fa fa-clock-o"></i> '.$newDate.'</span> </div><p>'.$fetch_reviews['customer_review'].'</p> </div></li>';
	}
}else{
	$error_msg['main_error'] .= 'No review yet';
}
echo json_encode($error_msg);
?>