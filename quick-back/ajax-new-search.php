<?php 
require_once "db/config.php"; 
// reviews show 
if(isset($_POST['reviews'])){
	if(isset($_POST['datepicker1']) && isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' AND  customer_reviews.review_posted_on >= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker1']))."' AND customer_reviews.review_posted_on <= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker2']))."' ");
	}else if(isset($_POST['datepicker1']) && !isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' AND  customer_reviews.review_posted_on >= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker1']))."' ");
	}else if(!isset($_POST['datepicker1']) && isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' AND customer_reviews.review_posted_on <= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker2']))."' ");
	}else if(!isset($_POST['datepicker1']) && !isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' ");
	}
	$j = 1;
	if(mysqli_num_rows($select_category)>0){
		$errmsg['no_error'] = '';
		
	while($fetch_category = mysqli_fetch_array($select_category)){
		$full_s_star = '';
		$empty_s_star = '';
		for($i=1;$i<=$fetch_category['customer_rating'];$i++){ 
			$full_s_star .= '<i class="fa fa-star" id="star-yellow"></i>';
		}
		for($i=1;$i<=(5-$fetch_category['customer_rating']);$i++){ 
		   	$empty_s_star .= '<i class="fa fa-star"></i>';
		}
		$errmsg['no_error'] .= '<tr><th scope="row">'.$j.'</th><td>'.$fetch_category['customer_name'].'</td><td style="width: 50%">'.$fetch_category['customer_review'].'</td><td>'.$full_s_star.$empty_s_star.'</td><td>'.$fetch_category['customer_email'].'</td><td>'.$fetch_category['property_name'].'</td></tr>';
        $j++;
	}
}else{
	$errmsg['main_error'] = "<p style='text-align:center;'>No relavent data found !!!</p>";
}
echo json_encode($errmsg);
}
// enquiry show 
if(isset($_POST['enquiry'])){
	if(isset($_POST['datepicker1']) && isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN listing_details ON customer_enquiry.property_id = listing_details.id  WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' AND  customer_enquiry.added_on >= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker1']))."' AND customer_enquiry.added_on <= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker2']))."' ");
	}else if(isset($_POST['datepicker1']) && !isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN listing_details ON customer_enquiry.property_id = listing_details.id  WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' AND  customer_enquiry.added_on >= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker1']))."' ");
	}else if(!isset($_POST['datepicker1']) && isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN listing_details ON customer_enquiry.property_id = listing_details.id  WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' AND customer_enquiry.added_on <= '".date('Y-m-d H:i:s',strtotime($_POST['datepicker2']))."' ");
	}else if(!isset($_POST['datepicker1']) && !isset($_POST['datepicker2']) && isset($_POST['search_ajax'])){
		$select_category = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN listing_details ON customer_enquiry.property_id = listing_details.id WHERE listing_details.property_name LIKE '%".$_POST['search_ajax']."%' ");
	}
	$j = 1;
	if(mysqli_num_rows($select_category)>0){
		$errmsg['no_error'] = '';
		
	while($fetch_category = mysqli_fetch_array($select_category)){
		$errmsg['no_error'] .= '<tr><th scope="row">'.$j.'</th>
                          <td >'.$fetch_category['customer_enquiry'].'</td>
                          <td>'.$fetch_category['customer_contact'].'</td>
                          <td>'.$fetch_category['customer_email'].'</td>
                          <td>'.$fetch_category['property_name'].'</td>
                          <td>'.date('Y-m-d',strtotime($fetch_category['added_on'])).'</td></tr>';
        $j++;
	}
}else{
	$errmsg['main_error'] = "<tr><td colspan='6'><p style='text-align:center;'>No relavent data found !!!</p></td></tr>";
}
echo json_encode($errmsg);
}
?>