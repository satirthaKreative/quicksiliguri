<?php require_once "db/config.php"; 
extract($_POST);
$search_value = mysqli_real_escape_string($conn,$_POST['search_value']);
   $error_msg['no_error'] = '';
   $insertQuery = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE prime_id = 0 AND (company_name like '%".$search_value."%' OR contact_person like '%".$search_value."%')   ORDER BY id DESC ");
   $i = 1;
   if(mysqli_num_rows($insertQuery)>0){
   while($fetchQuery = mysqli_fetch_array($insertQuery)){
   		$select_plan_id = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE prime_months = '".$fetchQuery['prime_id']."' ");
   		$fetch_plan_name = mysqli_fetch_array($select_plan_id);
   		// prime months
   			if($fetchQuery['prime_id']!=0){ 
   				$prime_months = $fetch_plan_name['prime_months']." months"; 
   			}else{ 
   				$prime_months = "FREE LISTING"; 
   			}
   		//Business Activity
   			if($fetchQuery['status'] == 1){ 
   				$business_activity = '<a href="javascript:;" class="text-success text-bold">Active</a>'; 
   			}else if($fetchQuery['status'] == 0){
   				$business_activity = '<a href="javascript:;" class="text-danger text-bold">Deactive</a>';
   			}
   		//Status Change
   			if($fetchQuery['status'] == 1){ 
   				$state_chaging = '<button type="button" class="btn btn-sm btn-warning" onclick="change_activity(0,'.$fetchQuery['id'].')">Change To Deactive</button>'; 
   			}else if($fetchQuery['status'] == 0){ 
   				$state_chaging = '<button type="button" onclick="change_activity(1,'.$fetchQuery['id'].')" class="btn btn-sm btn-info">Change To Active</button>';
   		    } 
   		    $error_msg['no_error'] .= "<tr><td>".$i."</td><td>".$fetchQuery['company_name']."</td><td>".$prime_months."</td><td><input type='checkbox' name='make_premium' class='make_premium' onchange='premium_state(this,".$fetchQuery['id'].")' /> <br>(Checked to make a premium member) <br></td><td>".$business_activity."</td><td>".$state_chaging."</td></tr>";	
   $i++; 
}
}else{
   $error_msg['no_error'] .= '<tr><td colspan="5">No data with this corresponding input</td></tr>';
}
  

echo json_encode($error_msg);

?>
