<?php require_once "db/config.php"; 
extract($_POST);
$select_ajax_cate = mysqli_query($conn,"SELECT * FROM `customer_enquiry` INNER JOIN `listing_details` ON customer_enquiry.property_id = listing_details.id WHERE property_name LIKE '%".$_POST['search_ajax']."%' AND (customer_enquiry.added_on > '".date('Y-m-d H:i:s',strtotime($_POST['datepicker1']))."' AND customer_enquiry.added_on <'".date('Y-m-d H:i:s',strtotime($_POST['datepicker2']))."') ");
$errmsg['no_error'] = '';
$j = 1;
while($fetch_ajax_cate = mysqli_fetch_array($select_ajax_cate)){
	if($fetch_ajax_cate['status'] == 1){ 
		$state = '<a href="#" class="text-bold text-success">Active</a>';
	}else if($fetch_ajax_cate['status'] == 0){ 
		$state = '<a href="#" class="text-bold text-danger">Deactive</a>';
	}
	if($fetch_ajax_cate['status'] == 1){ 
		$act_state = '<button type="button" class="btn btn-sm btn-warning" onclick="change_activity(0,'.$fetch_ajax_cate['id'].')">Change To Deactive</button>';
	}else if($fetch_ajax_cate['status'] == 0){ 
		$act_state = '<button type="button" onclick="change_activity(1,'.$fetch_ajax_cate['id'].')" class="btn btn-sm btn-info">Change To Active</button>';
	}
	$errmsg['no_error'] .= '<tr><th scope="row">'.$j.'</th><td>'.$fetch_ajax_cate['customer_enquiry'].'</td><td>'.$fetch_ajax_cate['customer_contact'].'</td><td>'.$fetch_ajax_cate['customer_email'].'</td><td>'.$fetch_ajax_cate['property_name'].'</td><td>'.date('Y-m-d',strtotime($fetch_ajax_cate['added_on'])).'</td></tr>';
$j++;
}
echo json_encode($errmsg);
?>