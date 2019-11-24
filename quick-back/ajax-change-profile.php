<?php require_once "db/config.php";

// Edit Profile Details 
extract($_POST);
if(isset($_SESSION['login_id'])){
	if($_POST['u_name'] == ''){
		$error_msg['main_error'] = "Enter a valid username";
	} else if($_POST['u_address'] == ''){
		$error_msg['main_error'] = "Enter your valid address";
	} else{
		if($_FILES['p_img']['size'] == 0){
			$update_profile_details = "UPDATE `admin` SET u_name = '".$_POST['u_name']."',  `u_quote` = '".$_POST['u_quote']."' , `u_address` = '".$_POST['u_address']."' WHERE id = '".$_SESSION['id']."' ";
			$exec_profile = mysqli_query($conn,$update_profile_details);
			if($exec_profile){
				$error_msg['no_error'] = "Profile Details Updated Successfully"; 
			} else{
				$error_msg['main_error'] = "Something Went Wrong ! try again later";
			}
		} else{
			$newimg = uniqid().$_FILES['p_img']['name'];
			move_uploaded_file($_FILES['p_img']['tmp_name'], "uploads/".$newimg);
			$update_profile_details = "UPDATE `admin` SET u_name = '".$_POST['u_name']."', `u_img` = '".$newimg."' `u_quote` = '".$_POST['u_quote']."' , `u_address` = '".$_POST['u_address']."' WHERE id = '".$_SESSION['id']."' ";
			$exec_profile = mysqli_query($conn,$update_profile_details);
			if($exec_profile){
				$error_msg['no_error'] = "Profile Details Updated Successfully"; 
			} else{
				$error_msg['main_error'] = "Something Went Wrong ! try again later";
			}
		}


	}
	echo json_encode($error_msg);
}

?>
