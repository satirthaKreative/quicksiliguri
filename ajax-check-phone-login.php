<?php require_once "quick-back/db/config.php"; ?>
<?php 

extract($_POST);
    if(strlen($_POST['phn_id']) != 10){
    	$error_msg['main_error'] = "Enter a valid phone number";
    }else{
    	$insertQuery = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE company_name = '".$_POST['com_id']."' AND (contact_number = '".$_POST['phn_id']."' OR alt_contact_no = '".$_POST['phn_id']."' ) ");
    	if(mysqli_num_rows($insertQuery)>0){
            $fetchQuery = mysqli_fetch_array($insertQuery);
            if($fetchQuery['admin_approval']==1){
                $error_msg['no_error'] = "<i class='fa fa-check'></i>";
            }else{
                $error_msg['main_error'] = "Your business doesn't approved by admin! Try later";
            }
    		
    	}else{
    		$error_msg['main_error'] = "This phone number is not registered";
    	}
    }
echo json_encode($error_msg);

?>